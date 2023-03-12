
# MessageApp

**MessageApp** is a project for beginners to see how to build an application with users and admin roles.

## Features
- User registration
- Sending email to verify registration.
- Login for users and admins.
- Forgot your password functionality with email send to change your password.
- User and Admin authentication, with sessions.
- As **Admin** you can:
  + Edit you profile.
  + See all registered users. 
  + Εdit user's informations.
  + Delete users with confirmation message.
  + See all messages together or each user's messages separately.
  + Logout.
- As **User** you can: 
  + Edit you profile.
  + Create messages.
  + View all your messages.
  + Logout.

## Tech stack
Here's an overview of the tech stack the **MessageApp** uses:

* **ApacheFriends XAMPP Version 8.2.0**. XAMPP is an easy to install Apache distribution containing MariaDB, PHP, and Perl. 
Specifically:   
  + Apache 2.4.54
  + MariaDB 10.4.27
  + PHP 8.2.0 (VS16 X86 64bit thread safe) + PEAR
  + phpMyAdmin 5.2.0
  + OpenSSL 1.1.1p
  + ADOdb 518a
  + Mercury Mail Transport System v4.63 (not included in the portable version)
  + FileZilla FTP Server 0.9.41 (not included in the portable version)
  + Webalizer 2.23-04 (not included in the portable version)
  + Strawberry Perl 5.32.1.1 Portable
  + Tomcat 8.5.79
  + XAMPP Control Panel Version 3.3.0.
  + XAMPP mailToDisk 1.0 (write emails via PHP on local disk in <xampp>\mailoutput. Activated in the php.ini as mail default.)

* **[Bootstrap 5.3.0-alpha1](https://getbootstrap.com/)** which is a powerful, extensible, and feature-packed frontend toolkit.

* **[PHPMailer](https://github.com/PHPMailer/PHPMailer)** A full-featured email creation and transfer class for PHP.

* **Font-awesome** version 6.3.0.

* Editor : **VSCode** version 1.75.1.  


## Installation

1. Download xampp from [here](https://www.apachefriends.org/download.html). 
2. Then you have to go to ./xampp/htdocs and paste the message folder.
3. Go to xampp/xampp-control and start Appache and MySQL. 
4. Open MySQL (http://localhost/phpmyadmin/) and import the file with the name msgapp.sql.
5. You are ready to see the application, go to this address (http://localhost/App/) in your browser.
