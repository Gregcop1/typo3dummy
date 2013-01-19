import java.net.*;
import java.io.*;
import java.util.*;
/**
 * <p>Title: Client HTTP Request class</p>
 * <p>Description: this class helps to send POST HTTP requests with various form data and also allows for progress 
 * to be shown
 * including files. Cookies can be added to be included in the request.</p>
 *
 * @author Jerome Schneider
 * This is an Enhancement of @version 1.0 by Tomer Petel
 *	Which is an Enhancement of ClientHTTPRequest, written by Vlad Patryshev
 */

public class HTTPClient {

	URL _url = null;
	ByteArrayOutputStream baos = new ByteArrayOutputStream();
    Map cookies = new HashMap();
	List lData = new ArrayList();

    AmeosJavascriptNotifier oNotifier=null;
    StringBuffer cookieList = new StringBuffer();
	private static Random random = new Random();
	String boundary = "---------------------------" + randomString() + randomString() + randomString();

	public HTTPClient(String sUrl) throws Exception {
		this(new URL(sUrl));
	}

	public HTTPClient(URL url) throws Exception {
		this._url = url;
	}
	
	protected URLConnection getConnection(int contentLength, String sReferer, String sUserAgent) throws Exception {

		HttpURLConnection connection = (HttpURLConnection)this._url.openConnection();
        connection.setFixedLengthStreamingMode(contentLength);
        connection.setDoOutput(true);
        connection.setUseCaches(false);
        connection.setDoInput(true);
        connection.setRequestMethod("POST");
        connection.setRequestProperty("Content-Type", "multipart/form-data; charset=UTF-8; boundary=" + boundary);
		connection.setRequestProperty("Referer", sReferer);
		
		connection.setRequestProperty("User-Agent", sUserAgent);				//
		HttpURLConnection.setDefaultRequestProperty("User-Agent", sUserAgent);	//	setting user-agent
		connection.setDefaultRequestProperty("User-Agent", sUserAgent);			//

        if(oNotifier != null) {
			oNotifier.setBytesToTransfer(contentLength);
		}
		
		if(cookieList.length() > 0) {
			connection.setRequestProperty(
				"Cookie",
				cookieList.toString()
			);
		}
		
		return connection;
    }
    
/*    protected void write(char c) throws Exception		{ baos.write(c);}
	protected void write(String s) throws Exception		{ baos.write(s.getBytes());}
*/

	protected void write(char c) throws Exception {
		this.lData.add(new java.lang.Character(c).toString());
	}

	protected void write(String s) throws Exception {
		this.lData.add(s);
	}

	protected void write(File oFile) throws Exception {
		this.lData.add(oFile);
	}

	protected void newline() throws Exception			{ write("\r\n");}
	
	protected void writeln(String s) throws Exception {
		write(s);
        newline();
    }

	
	protected static String randomString() {
        return Long.toString(random.nextLong(), 36);
    }
    
    private void boundary() throws Exception {
        write("--");
        write(boundary);
    }
	
	private void postCookies() {

		cookieList.delete(0, cookieList.length());
		
		for(Iterator i = cookies.entrySet().iterator(); i.hasNext();) {

			Map.Entry entry = (Map.Entry)(i.next());
			
			cookieList.append(entry.getKey().toString() + "=" + entry.getValue());
			
			if (i.hasNext()) {
				cookieList.append("; ");
			}
        }
    }
	
	//if you want to be notified for submission progress
    public void setNotifier(AmeosJavascriptNotifier oNotifier) {
		this.oNotifier = oNotifier;
	}

    public void setCookie(String name, String value) throws Exception {
		cookies.put(name, value);
	}
	
	public void setCookies(Map cookies) throws Exception {
		if (cookies == null) return;
        this.cookies.putAll(cookies);
    }
    
    /**
     * adds cookies to the request
     * @param cookies array of cookie names and values (cookies[2*i] is a name, cookies[2*i + 1] is a value)
     * @throws Exception
     */
    public void setCookies(String[] cookies) throws Exception {
        if (cookies == null) return;
        for (int i = 0; i < cookies.length - 1; i+=2) {
            setCookie(cookies[i], cookies[i+1]);
        }
    }
	
	private void writeName(String name) throws Exception {
        newline();
        write("Content-Disposition: form-data; name=\"" + name + '"');
    }
	
	public void setParameter(String name, String value) throws Exception {
		boundary();
        writeName(name);
        newline(); newline();
        writeln(value);
    }
	
	private void pipe(InputStream in, OutputStream out, boolean measureProgress) throws Exception {

		byte[] buf = new byte[500];
        int nread;
        int navailable;
        int total = 0;
		
		synchronized(in) {

			while((nread = in.read(buf, 0, buf.length)) >= 0) {

				out.write(buf, 0, nread);
                total += nread;
				
				if((oNotifier!=null) && (measureProgress))
				{
                    out.flush();
                    oNotifier.bytesTransferred(total);
                }
            }
        }
		
		out.flush();
        buf = null;
    }
    
    /**
     * adds a file parameter to the request
     * @param name parameter name
     * @param filename the name of the file
     * @param is input stream to read the contents of the file from
     * @throws Exception
     */
	 
	 public void setParameter(String name, String filename, InputStream oInStream) throws Exception {
        this.boundary();
        this.writeName(name); this.write("; filename=\"" + filename + '"');
        this.newline();

        this.writeln("Content-Type: application/octet-stream");
        this.newline();

        this.pipe(
			oInStream,
			this.baos,
			false
		);

        this.newline();
    }
    
    /**
     * adds a file parameter to the request
     * @param name parameter name
     * @param file the file to upload
     * @throws Exception
     */
    public void setParameter(String sName, File oFile) throws Exception {
//		setParameter(name, file.getPath(), new FileInputStream(file));
		
		this.boundary();
        this.writeName(sName); this.write("; filename=\"" + oFile.getPath() + '"');
        this.newline();

        this.writeln("Content-Type: application/octet-stream");
        this.newline();

/*        this.pipe(
			oInStream,
			this.baos,
			false
		);*/
		this.write(oFile);

        this.newline();
	}
    
    /**
     * adds a parameter to the request; if the parameter is a File, the file is uploaded, otherwise the string value of the parameter is passed in the request
     * @param name parameter name
     * @param object parameter value, a File or anything else that can be stringified
     * @throws Exception
     */
    public void setParameter(String name, Object object) throws Exception {

		if(object instanceof File) {
			setParameter(name, (File)object);
		} else {
			setParameter(name, object.toString());
		}
    }
    
    /**
     * adds parameters to the request
     * @param parameters "name-to-value" map of parameters; if a value is a file, the file is uploaded, otherwise it is stringified and sent in the request
     * @throws Exception
     */
    public void setParameters(Map parameters) throws Exception
	{
		if (parameters == null) return;
		
		for(Iterator i = parameters.entrySet().iterator(); i.hasNext();)
		{
			Map.Entry entry = (Map.Entry)i.next();
            setParameter(entry.getKey().toString(), entry.getValue());
        }
    }
    
    /**
     * adds parameters to the request
     * @param parameters array of parameter names and values (parameters[2*i] is a name, parameters[2*i + 1] is a value); if a value is a file, the file is uploaded, otherwise it is stringified and sent in the request
     * @throws Exception
     */
    public void setParameters(Object[] parameters) throws Exception
	{
		if(parameters == null) return;
		
		for(int i = 0; i < parameters.length - 1; i+=2)
		{ setParameter(parameters[i].toString(), parameters[i+1]);}
    }
    
    /**
     * posts the requests to the server, with all the cookies and parameters that were added
     * @return input stream with the server response
     * @throws Exception
     */
	public InputStream post(String sReferer, String sUserAgent) throws Exception {
		
		this.boundary();
        this.writeln("--");

		/**********************************************/
		//private void pipe(InputStream in, OutputStream out, boolean measureProgress) throws Exception {
/*
		byte[] buf = new byte[500];
        int nread;
        int navailable;
        int total = 0;
		
		synchronized(in) {

			while((nread = in.read(buf, 0, buf.length)) >= 0) {

				out.write(buf, 0, nread);
                total += nread;
				
				if((oNotifier!=null) && (measureProgress))
				{
                    out.flush();
                    oNotifier.bytesTransferred(total);
                }
            }
        }
		
		out.flush();
        buf = null;
		*/
	//}
		/**********************************************/

		Iterator oIt;
		Object oObj;
		File oFile;
		String sString;
		int iNbFiles = 0;

		int iSize = 0;
		oIt = this.lData.iterator();

		while(oIt.hasNext()) {
			oObj = oIt.next();
			
			if(oObj instanceof java.io.File) {
				// handle file
				oFile = (File)oObj;
				iSize += oFile.length();
				iNbFiles++;
			} else {
				// handle string
				iSize += oObj.toString().length();
			}
		}

		URLConnection oConn = this.getConnection(
			iSize,
			sReferer,
			sUserAgent
		);

		OutputStream oOutput = oConn.getOutputStream();

		this.oNotifier.bytesTransferred(0);

		/* sending */

		InputStream oInStream;
		byte[] buf = new byte[500];
        int nread;
        int navailable;
        int total = 0;
		int iCurFile = 0;
		
		
		oIt = this.lData.iterator();
		while(oIt.hasNext()) {
			
			oObj = oIt.next();
			
			if(oObj instanceof java.io.File) {
				// handle file
				iCurFile++;
				oFile = (File)oObj;
				oInStream = new FileInputStream(oFile);
				this.oNotifier.setProgressMessage(oFile.getName() + " [" + iCurFile + "/" + iNbFiles + "]");
			} else {
				// handle string
				sString = (String)oObj;
				oInStream = new ByteArrayInputStream(sString.getBytes());
			}


			synchronized(oInStream) {

				while((nread = oInStream.read(buf, 0, buf.length)) >= 0) {

					oOutput.write(buf, 0, nread);
					total += nread;
					
					if(this.oNotifier!=null) {
						this.oNotifier.bytesTransferred(total);
					}

					oOutput.flush();
				}
			}

			if(oObj instanceof java.io.File) {
				oInStream.close();
			}

			oInStream = null;
		}

		this.oNotifier.setProgressMessage("");

		oOutput.flush();
		oOutput.close();
        buf = null;

		/* END of sending */

		if(this.oNotifier!=null) {
			this.oNotifier.transferComplete();
		}

        return oConn.getInputStream();
/*
		this.boundary();
        this.writeln("--");
        this.baos.close();
        int length = this.baos.size();

        URLConnection connection = this.getConnection(length, sReferer, sUserAgent);
		OutputStream os = connection.getOutputStream();
        ByteArrayInputStream bais = new ByteArrayInputStream(this.baos.toByteArray());
        

		this.oNotifier.bytesTransferred(0);

		this.pipe(bais, os, true);	//should go straight to the net, thanks to setFixedLengthStreamingMode()
								//additional help at: http://bugs.sun.com/bugdatabase/view_bug.do?bug_id=50206745
		if(oNotifier!=null) {
			oNotifier.transferComplete();
		}

        os.close();
        return connection.getInputStream();*/
    }
}
