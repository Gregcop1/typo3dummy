public interface AmeosJavascriptNotifier {
    public void bytesTransferred(long bytes);
    public void setBytesToTransfer(long bytes);
	public void setProgressMessage(String sString);
    public void statusMessage(String status);
    public void transferComplete();
}