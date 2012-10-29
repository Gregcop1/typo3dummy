import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
import java.awt.dnd.*;
import java.awt.datatransfer.*;
import java.io.*;
import java.net.*;


public class AmeosDragNDropUpload extends JApplet implements AmeosJavascriptNotifier {

	public DropTargetImage dropZone = null;
	public JProgressBar progressBar = null;
	public JTextArea textArea = null;
	public JScrollPane scrollPane = null;
	public String sDam = null;

	public void init() {

		String sUploadUrl		= this.getParameter("uploadurl");
		String sUploadTarget	= this.getParameter("target");
		String sCookies			= this.getParameter("cookies");
		String sUserAgent		= this.getParameter("useragent");
		String sMaxUploadSize	= this.getParameter("maxuploadsize");
		this.sDam				= this.getParameter("dam");

		if(sUploadUrl != null) {

			try {
				String sImgURL = getClass().getResource("typo3logo.gif").toString();
				this.dropZone = new DropTargetImage(this, sImgURL, sUploadUrl, sUploadTarget, sCookies, sUploadUrl, sUserAgent, sMaxUploadSize);
			} catch(java.net.MalformedURLException e) {
				JOptionPane.showMessageDialog(null, "Error : Picture not loaded!");
			}
			
			// on défère l'éxécution de l'affichage du GUI dans un Thread indépendant
			// pour soulager les refresh de l'interface
			try {

				javax.swing.SwingUtilities.invokeAndWait(
					new Runnable() {
						public void run() { createGUI();}
					}
				);
			} catch(Exception e) {
				System.err.println("createGUI failed");
			}
			
			this.logMessage("> Ready for mass upload");
			this.logMessage("> Max size per single file: " + this.dropZone.getHRSize(sMaxUploadSize));
			this.setProgressMessage("Drop files/folders on the image above");
		}
	}

	private void createGUI() {

		BorderLayout oLayout = new BorderLayout(0, 0);
		this.getContentPane().setLayout(oLayout);
		this.dropZone.setPreferredSize(new Dimension(470, 226));
		this.getContentPane().add(this.dropZone, BorderLayout.NORTH);

		this.progressBar = new JProgressBar();
		this.progressBar.setStringPainted(true);
		this.progressBar.setPreferredSize(new Dimension(470, 22));
		this.getContentPane().add(this.progressBar, BorderLayout.CENTER);

		this.textArea = new JTextArea(12, 10);
		this.textArea.setEditable(false);
        this.textArea.setLineWrap(true);
        this.textArea.setWrapStyleWord(true);

		this.scrollPane = new JScrollPane(this.textArea);
		this.scrollPane.setVerticalScrollBarPolicy(JScrollPane.VERTICAL_SCROLLBAR_AS_NEEDED);

		this.getContentPane().add(
			this.scrollPane,
			BorderLayout.SOUTH
		);
	}

	public String getParameter(String sParamName) {

		try {
			return super.getParameter(sParamName);
		} catch(NullPointerException e) {
			return null;
		}
    }

	public void logMessage(String sMessage) {		
		this.textArea.insert(sMessage + "\n", 0);
	}

	public void popMessage(String sMessage) {
		try {

			URL u = new URL("javascript:void(alert('" + sMessage + "'));");      
			this.getAppletContext().showDocument(u);
		} catch(Exception e) {}
	}

	public String rawURLEncode(String sUrl) {
		
		byte[] bytes = null;

		try { bytes = sUrl.getBytes("ASCII");} catch(Exception e) { return "";}
        StringBuffer sb = new StringBuffer();
        
        for(int x = 0; x < (bytes.length - 1); x++) {

            sb.append(
				(new Byte(bytes[x])).toString()
			);
            sb.append(",");
        }

		sb.append(
			(new Byte(bytes[bytes.length - 1])).toString()
		);
        
        return sb.toString();

	}
	
	// implementation de AmeosJavascriptNotifier
    private void appendMsg(final String msg) {

		SwingUtilities.invokeLater(
			new Runnable() {
				public void run() {
					AmeosDragNDropUpload.this.logMessage(msg);
				}
			}
		);
    }
	
	public void setProgressMessage(final String sString) {

		SwingUtilities.invokeLater(
			new Runnable() {
				public void run() {
					AmeosDragNDropUpload.this.progressBar.setString(
						sString
					);
				}
			}
		);
	}
	
	public void bytesTransferred(final long bytes) {

		final int iKB = (int)(bytes/1024);
		SwingUtilities.invokeLater(
			new Runnable() {
				public void run() {
					AmeosDragNDropUpload.this.progressBar.setValue(iKB);
				}
			}
		);
    }
	
	public void setBytesToTransfer(final long bytes) {

		final int maxKB = (int)(bytes/1024);
		SwingUtilities.invokeLater(
			new Runnable() {
				public void run() {
					AmeosDragNDropUpload.this.progressBar.setMaximum(maxKB);
				}
			}
		);
    }
	
	public void statusMessage(final String status) {

		SwingUtilities.invokeLater(
			new Runnable() {
				public void run() {
					AmeosDragNDropUpload.this.logMessage(status);
				}
			}
		);
    }
	
	public void transferComplete() {
		if(Integer.parseInt(this.sDam) == 1) {
			this.logMessage("> DAM integration: processing, please wait\n");
		} else {
			this.logMessage("> Server side processing: please wait\n");
		}
    }
}