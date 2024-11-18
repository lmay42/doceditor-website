<h2>Doceditor Website</h2>

Write documents like a pro over the internet. A make-shift google docs that writes to text documents.

<b>Setup</b>

place into the /html folder on the webserver.

<b>Password Authentication</b>

The documents can be secured with a password system by creating a text file named "passwords.txt" in your main folder (/html) next to the login.php script. In the passwords.txt:

  first line will be your view password that allows viewing
  second line will be your editing password that allows viewing and editing
  
If no passwords.txt is made, the user is automatically granted edit privelages.
