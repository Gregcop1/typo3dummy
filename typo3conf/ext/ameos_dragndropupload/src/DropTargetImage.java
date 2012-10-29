import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
import java.awt.dnd.*;
import java.awt.datatransfer.*;
import java.io.*;
import java.util.*;
import java.net.*;

public class DropTargetImage extends JLabel implements DropTargetListener {

	private AmeosDragNDropUpload oParent			= null;
	DropTarget dropTarget			= null;
	private String sUploadUrl		= "";
	private String sUploadTarget	= "";
	private String sCookies			= "";
	private String sReferer			= "";
	private String sUserAgent		= "";
	private int sMaxUploadSize		= 0;

	private Hashtable aCurrentDirs	= null;		// temporary buffers
	private Hashtable aCurrentFiles	= null;		// for use in getStructure();

	public DropTargetImage(
		AmeosDragNDropUpload oParent,
		String imageUrl,
		String sUploadUrl,
		String sUploadTarget,
		String sCookies,
		String sReferer,
		String sUserAgent,
		String sMaxUploadSize
	) throws java.net.MalformedURLException {

		super(new ImageIcon(new URL(imageUrl)));
		// Steps 1, 2, and 3: Create a DropTarget that watches this JList (first this) and
		// sends notification events to this class (second this)
		
		this.oParent = oParent;
		this.sUploadUrl = sUploadUrl;
		this.sUploadTarget = sUploadTarget;
		this.sCookies = sCookies;
		this.sReferer = sReferer;
		this.sUserAgent = sUserAgent;
		this.sMaxUploadSize = Integer.parseInt(sMaxUploadSize);

		dropTarget = new DropTarget(this, this);
	}
	
	// Step 4: Handle dragged object notifications
	
	public void dragExit(DropTargetEvent dte)				{/* System.out.println("DT: dragExit");*/}
	public void dragEnter(DropTargetDragEvent dtde)			{ /*System.out.println("DT: dragEnter");*/}
	public void dragOver(DropTargetDragEvent dtde)			{ /*System.out.println("DT: dragOver");*/}
	public void dropActionChanged(DropTargetDragEvent dtde)	{ /*System.out.println("DT: dropActionChanged");*/}
	
	// Step 5: Handle the drop
	public void drop(DropTargetDropEvent dtde) {
		
		try {
			Boolean supportedDataFlavor = false;
			java.util.List fileList = new java.util.ArrayList(0);
			DataFlavor uriListFlavor = new DataFlavor("text/uri-list; class=java.lang.String");

			Transferable tr = dtde.getTransferable();

			try {
				if(tr.isDataFlavorSupported(DataFlavor.javaFileListFlavor)) {
					dtde.acceptDrop(DnDConstants.ACTION_COPY_OR_MOVE);
					fileList = (java.util.List)tr.getTransferData(DataFlavor.javaFileListFlavor);
					// the list contains java.io.File(s)
					System.out.println(fileList);
					supportedDataFlavor = true;
				} else if(tr.isDataFlavorSupported(uriListFlavor)) {
					dtde.acceptDrop(DnDConstants.ACTION_COPY_OR_MOVE);
					String data = (String)tr.getTransferData(uriListFlavor);
					fileList = textURIListToFileList(data);
					System.out.println(fileList);
					supportedDataFlavor = true;
				}
			} catch(Exception e) {
				e.printStackTrace();
			}

//			if(tr.isDataFlavorSupported(DataFlavor.javaFileListFlavor))	/* normal way to handle transferable */
			if(supportedDataFlavor) {
				// il s'agit d'un fichier
				System.err.println("Drop event Accepted! " + tr.toString());

				
				//java.util.List aFiles = new ArrayList();
				Hashtable aFiles = new Hashtable();

				
//				java.util.List fileList = (java.util.List)tr.getTransferData(DataFlavor.javaFileListFlavor);
				Iterator iterator = fileList.iterator();
				
				while(iterator.hasNext()) {

					File file = (File)iterator.next();
					
					Hashtable hashtable = new Hashtable();
					hashtable.put("name",file.getName());
					hashtable.put("url",file.toURL().toString());
					hashtable.put("path",file.getAbsolutePath());
					
					String s = "";

					if(file.getName().endsWith(".lnk")) {

						// il s'agit d'un lien windows
						// on le décrypte
						try
						{
							File oFile = new File(file.getAbsolutePath());
							LnkParser oParser = new LnkParser(oFile);
							File oRealFile = new File(oParser.getRealFilename());
							aFiles.put(
								oRealFile.hashCode() + "=>" + "",	// no subdir to create
								oRealFile
							);

							s = "Lien Windows : " + oParser.getRealFilename();
						}
						catch(Exception e) {}

					} else if(file.isDirectory()) {

						// d'un répertoire
						s = "Directory : " + file.getAbsolutePath();
						this.logMessage(s);


						this.aCurrentDirs = new Hashtable();
						this.aCurrentFiles = new Hashtable();
						this.getStructure(file);

						Iterator i = this.aCurrentFiles.entrySet().iterator();
						while(i.hasNext()){
							File oCurFile = (File)((Map.Entry)i.next()).getValue();
							//this.logMessage(oCurFile.getAbsolutePath());

							String sSubDir = oCurFile.getParentFile().getAbsolutePath().substring(file.getParentFile().getAbsolutePath().length());	// removing parent pathes

							aFiles.put(
								oCurFile.hashCode() + "=>" + sSubDir,
								oCurFile
							);
						}
						
						this.aCurrentDirs = new Hashtable();
						this.aCurrentFiles = new Hashtable();

/*						File[] aFilesDir = file.listFiles();
						
						for(int i = 0; i < aFilesDir.length; i++) {
							//fileList.add(aFilesDir[i]);
							this.logMessage(aFilesDir[i].getAbsolutePath());
						}
						*/

					} else {

						// d'un fichier
						s = "Fichier	: " + file.getAbsolutePath();
						aFiles.put(
							file.hashCode() + "=>" + "",	// no subdir to create
							file
						);
					}

//					String s = file.getName();
//					addElement(s);
				}
				
				dtde.getDropTargetContext().dropComplete(true);

				System.out.println("Fichiers : " + aFiles.toString());
//				this.logMessage(aFiles.toString());
				
				// on envoie les fichiers sur le serveur
				this.uploadFiles(aFiles);

			} else {
				System.err.println("Drop event Rejected! " + tr.toString());
				dtde.rejectDrop();
			}
		} catch(IOException io) {

			io.printStackTrace();
			dtde.rejectDrop();
		} catch(Exception e) {
			e.printStackTrace();
			dtde.rejectDrop();
		}
	}

	public void getStructure(File oFile) {
		if(oFile.isDirectory()) {
			
//			this.logMessage("CREATE DIR::" + oFile.getAbsolutePath());
			this.aCurrentDirs.put(oFile.hashCode(), oFile);

			File[] aFilesDir = oFile.listFiles();
			for(int i = 0; i < aFilesDir.length; i++) {
				//fileList.add(aFilesDir[i]);

				if(aFilesDir[i].isDirectory()) {
					this.getStructure(aFilesDir[i]);
				} else {
					this.aCurrentFiles.put(aFilesDir[i].hashCode(), aFilesDir[i]);
//					this.logMessage("FILE::" + aFilesDir[i].getAbsolutePath());
				}
			}
		}
	}

	public void addElement(Object s) {
		System.out.println(s.toString());
	}
	
	public void removeElement() {
		/*(( DefaultListModel)getModel()).removeElement(getSelectedValue());*/
	}

	public void uploadFiles(final Hashtable aFiles) {

		System.out.println("uploadFiles::1");

		/*

			Iterator i = aFiles.entrySet().iterator();
			while(i.hasNext()){
				File oCurFile = (File)((Map.Entry)i.next()).getValue();
			}

		*/

		Thread uploadThread = new Thread(
			new Runnable() {
				public void run() {

					try {
						try {
							
							HTTPClient oClient = new HTTPClient(DropTargetImage.this.sUploadUrl);
							oClient.setNotifier(DropTargetImage.this.oParent);

							try {
								try {

									oClient.oNotifier.setProgressMessage("Preparing upload...");

									int nbFiles = aFiles.size();
									long totalSize = 0;
									int currentFile = 0;
									int filesSuccess = 0;
									int filesFailed = 0;
									Iterator iterator = aFiles.entrySet().iterator();
									
									while(iterator.hasNext()) {
										Map.Entry mCurrent = (Map.Entry)iterator.next();
										File oCurFile = (File)mCurrent.getValue();
										String sCurSubDir = (String)mCurrent.getKey();
										
										sCurSubDir = sCurSubDir.substring(
											sCurSubDir.indexOf("=>") + 2,
											sCurSubDir.length()
										);

//										DropTargetImage.this.logMessage("On uploade " + oCurFile.getName() + " dans " + sCurSubDir);



										currentFile++;
										
										try { Thread.sleep(10);} catch(Exception e) {}

										

//										File oFile = (File)iterator.next();
										long fileSize = oCurFile.length();
										
										if(fileSize > DropTargetImage.this.sMaxUploadSize) {

											DropTargetImage.this.logMessage(
												"> Preparing " + oCurFile.getName() + ", " + DropTargetImage.this.getHRSize(fileSize) + " [" + currentFile + "/" + nbFiles + "] SKIPPED, file too big"
											);

											filesFailed++;
										} else {

											String sInput = "file[upload][" + filesSuccess + "]";
											String sInputFile = "upload_" + filesSuccess;

											totalSize += fileSize;
											
											String sMsg = "> Preparing " + oCurFile.getName() + ", " + DropTargetImage.this.getHRSize(fileSize) + " [" + currentFile + "/" + nbFiles + "]";
											
											DropTargetImage.this.logMessage(sMsg);

											long beforeTime = System.currentTimeMillis();
											
											/*try { Thread.sleep(30);} catch(Exception e){}*/

											oClient.setParameter(sInputFile, oCurFile);
											long afterTime = System.currentTimeMillis();


											long totalTime = afterTime - 30 - beforeTime;
											
											oClient.setParameter(sInput + "[target]", DropTargetImage.this.sUploadTarget);
											oClient.setParameter(sInput + "[data]", filesSuccess);
											oClient.setParameter(sInput + "[filename]", new String(oCurFile.getName().getBytes(), "UTF-8"));
											oClient.setParameter(sInput + "[directory]", new String(sCurSubDir.getBytes(), "UTF-8"));

											filesSuccess++;
										}
									}


									oClient.setParameter("number", filesSuccess);
									oClient.setParameter("dam", Integer.parseInt(DropTargetImage.this.oParent.sDam));

									if(filesSuccess > 0) {
										DropTargetImage.this.logMessage("> Starting transfer, " + filesSuccess + " file(s), total " + DropTargetImage.this.getHRSize(totalSize));
									}

									InputStream in = oClient.post(
										DropTargetImage.this.sUploadUrl,
										DropTargetImage.this.sUserAgent
									);

									

//									DropTargetImage.this.logMessage("Reading server response");
									
									BufferedReader bin = new BufferedReader(new InputStreamReader(in));
									String line=null;
									StringBuffer oResponse = new StringBuffer();
									StringBuffer oResponseError = new StringBuffer();
									
									while((line=bin.readLine())!=null) {
										oResponse.append(line);
										oResponseError.append("> " + line + "\n");
									}

									if(Integer.parseInt(DropTargetImage.this.oParent.sDam) == 1) {
										DropTargetImage.this.logMessage("> DAM integration: done");
									} else {
										DropTargetImage.this.logMessage("> Server side processing: done");
									}

									if(oResponse.toString().compareTo("OK") == 0) {
										DropTargetImage.this.logMessage("> All files are uploaded\n");
									} else if(oResponse.toString().compareTo("NOK") == 0) {
										DropTargetImage.this.logMessage("> [ERROR] NO FILE HAS BEE UPLOADED; try uploading a smaller batch of files\n");
									} else {
										DropTargetImage.this.logMessage(oResponseError.toString());
									}

									//DropTargetImage.this.logMessage("#" + oResponse.toString() + "#");
									
									


									if(filesSuccess > 0 && filesFailed == 0) {
										DropTargetImage.this.logMessage("----- " + filesSuccess + " file(s) transfered, total " + DropTargetImage.this.getHRSize(totalSize) + " -----");
									} else if(filesSuccess > 0 && filesFailed > 0) {
										DropTargetImage.this.logMessage("----- " + filesSuccess + " file(s) transfered, total " + DropTargetImage.this.getHRSize(totalSize) + " ; " + filesFailed + " skipped -----");
									}
									
									if(filesSuccess == 0) {
										DropTargetImage.this.logMessage("----- No file transfered during process -----");
									}
									
									DropTargetImage.this.oParent.bytesTransferred(0);
									DropTargetImage.this.oParent.setProgressMessage("Drop files/folders on the image above");

									//System.out.println("---REPONSE---" + send.toString());
								}
								catch(java.lang.NullPointerException e) { System.err.println("NullPointerException" + e.toString());}
							}
							catch(java.io.IOException e) { System.err.println("IOException:1:" + e.toString());}
						}
						catch(java.io.IOException e) { System.err.println("IOException:2:" + e.toString());}
					}
					catch(Throwable t) { DropTargetImage.this.logMessage(getExceptionTrace(t));}
				}
			}
		);
		
		uploadThread.start();
	}

	private String getExceptionTrace(Throwable t) {

		StringWriter sw = new StringWriter();
        t.printStackTrace(new PrintWriter(sw));
        String disp = sw.toString();
        String disp2 = "";
		
		for(int i = 0; i < disp.length(); i++)
		{
			if(disp.charAt(i)!='\r')
			{
				if(disp.charAt(i)=='\t')
				{ disp2+="   ";}
				else
				{ disp2+=disp.charAt(i);}
			}
		}
		
		return disp2;
    }

	public String getHRSize(String rawSize)  {
		try {
			return this.getHRSize(
				Long.parseLong(rawSize, 10)
			);
		} catch(Exception e) {
			return "N/A";
		}
	}
	
	public String getHRSize(long rawSize)  {

		if(rawSize / 1048576 > 1) {
			return Math.round(rawSize / 1048576) + "MB";
		} else if(rawSize / 1024 >= 1) {
			return Math.round(rawSize / 1024) + "KB";
		} else {
			return Math.round(rawSize) + " Bytes";
		}
	}

	public void logMessage(String sMsg) {
		this.oParent.logMessage(sMsg);
	}

	private static java.util.List textURIListToFileList(String data) {

		java.util.List list = new java.util.ArrayList(1);
		for(java.util.StringTokenizer st = new java.util.StringTokenizer(data, "\r\n"); st.hasMoreTokens();) {

			String s = st.nextToken();
			
			if(s.startsWith("#")) {
				// the line is a comment (as per the RFC 2483)
				continue;
			}
			
			try {
				java.net.URI uri = new java.net.URI(s);
				java.io.File file = new java.io.File(uri);
				list.add(file);
			} catch(java.net.URISyntaxException e) {
				// malformed URI
			} catch(IllegalArgumentException e) {
				// the URI is not a valid 'file:' URI
			}
		}
		
		return list;
	}
}