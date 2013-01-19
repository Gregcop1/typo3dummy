cls
@echo compiling + jaring + signing + moving
@del %1.jar

javac %1.java
echo Main-Class: %1> manifest.temp
jar cmvf manifest.temp %1.jar *.class up.gif typo3logo.gif
@del manifest.temp
@del *.class
echo %1.jar created



pause Signing applet
@del %1.jar.sig
@del %1.jar.orig

jarsigner %1.jar ameoskey

pause Moving to dev http dir
@del R:\sandbox.ameos.local\html\typo3conf\ext\ameos_dragndropupload\res\jar\AmeosDragNDropUpload.jar
@move AmeosDragNDropUpload.jar R:\sandbox.ameos.local\html\typo3conf\ext\ameos_dragndropupload\res\jar\