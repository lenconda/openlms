# OpenLMS

## Features
  - Add,delete and update books in library;
  - Add,blacklist and update user info;
  - Borrow,return and delay book requests;
  - Readers and administrators are allowed to login at a general login system.
  
 ## Quickstart
 
 ### Download
 
  Click [here](https://github.com/lenconda/openlms/releases) to download the latest version.
  
 ### Requirements
 
  - System: Windows/UNIX/Linux/macOS
  - Software environment: Apache/Nginx,PHP support
  - Browsers: Chrome/Firefox/IE 8.0 or higher/Opera ,etc.
  
 ### Startup(Use Linux for example)
 
 #### Unpack
 
  1. Unpack the software package
  2. Move the root directory(such as openlms/) to your web server,for example,if the document root of your Apache server is `/var/www/html/`,you should move openlms/ to there by executing 
    ```
    [root@localhost ~]# mv openlms /var/www/html/
    ```
  - About the configuration file: inorder to make web server return `index.php` when you require the `/` of OpenLMS
  
  #### 
