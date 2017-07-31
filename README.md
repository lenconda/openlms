# OpenLMS

## Screenshot

  ![screenshot1](http://lanconda.github.io/screenshot1.png)
  ![screenshot2](http://lenconda.github.io/screenshot2.png)

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
  
  #### Configure
  
  ##### Create & Insert Data Into Database
  
  OpenLMS uses MySQL as default database.
  
  - For the purpose of building database easier,there is a MySQL script available at `/database` which filename is `/database/library.sql`
  
  - To simply use this script to create database,please follow the following steps:
  
  Let's say that the script is in `/tmp/library.sql`
  ```
   mysql> CREATE DATABASE `library`; //This is the name of your database,you can change it.
   
   mysql> USE `library`;
   
   mysql> SOURCE /tmp/library.sql;
  ```
All the data will be written in,no surprise.Notice that DELETE THE DIRECTORY `/database/*` WHEN YOU FINISH THESE STEPS!!!
 
  ###### Edit The Configuration File
  
  Now,cd into the root of OpenLMS,you shoud have these files:
  
  ```
.
├── assets
│   ├── footer.php
│   ├── head.php
│   └── sidebar.php
├── book_admin.php
├── bootstrap
│   ├── bootstrap.css
│   ├── bootstrap.css.map
│   ├── bootstrap.min.css
│   ├── bootstrap-theme.css
│   ├── bootstrap-theme.css.map
│   └── bootstrap-theme.min.css
├── borrowed.php
├── config
│   └── config_inc.php
├── css
│   ├── bootstrap.css
│   ├── bootstrap-datetimepicker.css
│   ├── component.css
│   ├── datetime.css
│   ├── style.css
│   └── styles.css
├── database
│   └── openlms.sql
├── delay.php
├── index.php
├── js
│   ├── bootstrap-datetimepicker.js
│   ├── bootstrap.js
│   ├── bootstrap.min.js
│   ├── classie.js
│   ├── datetime.js
│   ├── jquery-1.9.1.js
│   ├── modalEffects.js
│   └── npm.js
├── jump.php
├── LICENSE
├── login.php
├── logout.php
├── profile
│   ├── assets
│   │   └── head.php
│   ├── config
│   │   └── config_inc.php
│   └── index.php
├── README.md
├── returned.php
├── return.php
├── search.php
└── users.php
  ```
  
  - In order to make OpenLMS connect to your database successfully,you have to edit the global configuration file `/config/config_inc.php`
  
  - Here are the vital parameters in that file:
  
  ```
    $HOSTNAME='localhost';
    $USERNAME='root';
    $PASSWORD='123';
    $DATABASE='library';
  ```
   `$HOSTNAME` is the URL of your MySQL server,`$USERNAME` is the username of the user who has the privilege to `library` database,`$PASSWORD` is the user's password,and `$DATABASE` is OpenLMS database.
   
   - OK,now OpenLMS is configured succefully.
   
   ### Use OpenLMS
   
   #### Default Username & Password
   
   There are 2 users in OpenLMS,one is administrator,the other is reader.OpenLMS has a general login system,that is,administrators and readers use the same login system.
   
   + OpenLMS uses ID Card number as username.
   
   - The default username and password as following:
   
   Administrator: login name is `360101300001014816`,password is `openlms123`
   
   Reader: login name is `36010130011231032X`,password is `openlms123`
   
   #### Privileges
   
   - Administrators can create,delete administrators and readers,they can modify there personal information;They can also add,delete,modify,borrow,return books.
   
   - Readers can modify there personal information,view the borrow list,and push delay request to administrators;They can modify there passwords,but they can not delete themselves.
  
   
   
