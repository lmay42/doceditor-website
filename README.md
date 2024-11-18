<h2>Doceditor Website</h2>

Write documents like a pro over the internet. A make-shift google docs that writes to text documents.

Uses PHP for backend and authentication, and some light Javascript for the creating of text documents. CSS made with Tailwind.



<b>Setup</b>

place into the /html folder on the webserver.




<b>Password Authentication</b>

The documents can be secured with a password system by creating a text file named "passwords.txt" in your main folder (/html) next to the login.php script. In the passwords.txt:

  first line will be your view password that allows viewing
  second line will be your editing password that allows viewing and editing

If no passwords.txt is made, the user is automatically granted edit privelages and pressing "login" will send you in regardless.





<b>Storage</b>

Documents are stored in the /files folder. these should be editable by default, but may require some permission finicking as they are created by "daemon".
