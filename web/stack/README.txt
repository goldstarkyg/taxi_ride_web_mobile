		      Bitnami LAMP Stack 5.6.30-2
		    ===========================

1. OVERVIEW

The Bitnami Project was created to help spread the adoption of freely
available, high quality, open source web applications. Bitnami aims to make
it easier than ever to discover, download and install Open Source software 
such as document and content management systems, wikis and blogging 
software.

You can learn more about Bitnami at https://bitnami.com

Bitnami LAMP stack is an easy to install and easy to use open source Web 
Platform. It combines leading open source projects, such as Apache, MySQL 
and PHP with BitRock's extensive open source expertise to provide a consistent, 
painless way to deploy LAMP in any Linux environment.

You can learn more about Bitnami stacks at https://bitnami.com/stacks/

You can also add applications on top of this stack like WordPress, Drupal, Joomla!,
SugarCRM and more. You can download the Bitnami module for any of these applications
and install on top of your LAMP installation. That way, all of the Bitnami-packaged 
applications you want to run will share a single instance of Apache, MySQL and PHP 
which will save space and improve performance.

You can learn more about installing modules at
https://docs.bitnami.com/?page=infrastructure&name=lamp&section=how-can-i-add-applications-on-top-of-lamp


Bitnami LAMP is also available as a Virtual Machine Image or as a Cloud Image.
Bitnami Virtual Machine Images are pre-configured and include a minimal 
installation of Linux and a Bitnami stack. They are available for VMWare and 
the latest version of VirtualBox. Bitnami Cloud Images allow you to run a 
Bitnami stack in a cloud computing environment on a pay-as-you-go basis. 
Bitnami Cloud Images are currently available for Amazon EC2, with planned 
support for additional cloud environments.

You can learn more about Bitnami Virtual Machine Images and Cloud Images at
https://bitnami.com/learn_more


2. FEATURES

- Easy to Install

Bitnami stacks are built with one goal in mind: to make it as easy as
possible to install open source software. Our installers completely automate
the process of installing and configuring all of the software included in
each stack, so you can have everything up and running in just a few clicks.

- Independent

Bitnami stacks are completely self-contained, and therefore do not interfere
with any software already installed on your system. For example, you can
upgrade your system's MySQL or Apache Tomcat without fear of 'breaking' your
Bitnami stack.

- Integrated

By the time you click the 'finish' button on the installer, the whole stack
will be integrated, configured and ready to go. 

- Relocatable

Bitnami stacks can be installed in any directory. This allows you to have
multiple instances.


3. COMPONENTS

Bitnami LAMP stack ships with the following software versions:
 
   - Apache 2.4.25
   - MySQL 5.6.35
   - PHP 5.6.30
   - PHPMyAdmin 4.7.0
   - AWS SDK for PHP 1.6.2
   - Varnish 4.1.0
   - ImageMagick 6.7.5
   - SQLite 3.7.15.1
   - ModSecurity 2.6.7
   - Libraries for Couchbase 2.0.5
   - Couchbase PHP extension 1.1.5
   - Git 2.7.4

Optional components:

   - Zend Framework 3.0.2
   - Symfony 2.8.18
   - CodeIgniter 3.1.4
   - CakePHP 3.4.4
   - Smarty 3.1.31
   - Laravel 5.4.16

You can find a quick start guide and more documentation about all of the
components at:

http://docs.bitnami.com/?page=infrastructure&name=lamp


4. REQUIREMENTS

To install Bitnami LAMP stack you will need:

    - Intel x86 or compatible processor
    - Minimum of 256 MB RAM
    - Minimum of 150 MB hard drive space
    - An x86 Linux operating system
    - TCP/IP protocol support


5. INSTALLATION

The Bitnami LAMP stack is distributed as a binary executable installer.
It can be downloaded from:

https://bitnami.com/stacks/

The downloaded file will be named something similar to:

bitnami-lampstack-5.6.30-2-linux-installer.run on Linux or
bitnami-lampstack-5.6.30-2-linux-x64-installer.run on Linux 64 bit.

You can install Bitnami LAMP stack in graphical, text and unattended modes. 
By default the graphical mode will be used.

On Linux, you will need to give it executable permissions:

chmod 755 bitnami-lampstack-5.6.30-2-linux.run

You will be greeted by the 'Welcome' screen. 

The next step is to select the installation directory. The default installation 
path will be a folder on your home directory if you are running the installer as 
a regular user, or /opt/lampstack-5.6.30-2, if you are running the 
installation as root. If the destination directory does not exist, it will be 
created as part of the installation.

After selecting the installation directory you will be asked for the password 
to the initial MySQL root and anonymous accounts. This password cannot be empty.

The default listening port for Apache is 8080 and for MySQL is 3306. If those 
ports are already in use by other applications, you will be prompted for 
alternate ports to use. Remember that if you plan to run both applications as a 
regular user you should select port numbers above 1024.

You are now ready to begin the installation, which will start when you press 
'Next'. 

Once the installation process has been completed, you will see the 'Installation 
Finished' page.

If you receive an error message during installation, please refer to the 
Troubleshooting section.

The rest of this guide assumes that you installed Bitnami LAMP stack in 
/home/user/lampstack-5.6.30-2 and that you use port 8080 for Apache and 3306 for MySQL.

6. STARTING AND STOPPING BITNAMI LAMP STACK

To enter to your application you can point your browser to
http://127.0.0.1:8080/

To start/stop/restart application you can use a graphical management tool
called 'manager-linux.run'. Double-click on that file or start it from a 
command line:

       ./manager-linux.run

You can also use the command line ctlscript.sh utility:

       ./ctlscript.sh (start|stop|restart)
       ./ctlscript.sh (start|stop|restart) mysql
       ./ctlscript.sh (start|stop|restart) apache

  start      - start the service(s)
  stop       - stop  the service(s)
  restart    - restart or start the service(s)

If you selected an alternate port during installation, for example 18080, the
URL will look like:

http://127.0.0.1:18080/

7. RUNNING COMMANDS IN A CONSOLE

Bitnami console is a script that loads environment variables that need
to be present when using many of the command line tools included in
the stack, such as mysql, php or openssl.

All of the Native Installers for Bitnami Stacks are completely self-contained 
and run independently of the rest of the software or libraries installed
on your system. For this to work, certain environment variables need
to be configured properly. Before running any stack command line tool, you 
should start the "Bitnami console" to setup the environment. For example
to check the MySQL or PHP version.

On Linux or OS X, you have to start a Terminal and run the following commands
into your installation directory:

     ./use_lampstack
     php -v
     mysql -Version

On Windows, you can start the Bitnami console from the Start Menu:

    Start -> Program Files -> Bitnami WAMP Stack -> Use WAMP Stack

    php -v
    mysql -Version


8. DIRECTORY STRUCTURE

The installation process will create several subfolders under the main 
installation directory:

   manager-linux.run: Graphical tool to manage the servers easily
   ctlscript.sh: Script to manage the servers
   uninstall: Uninstaller
   use_lampstack: Script to load the stack environment

   apache2/: Apache Web server.
   php/: PHP Scripting Language.
   mysql/: MySQL Database.
   common/: common libraries.
   varnish/: Varnish cache server (disabled by default)
   sqlite/: SQLite database server
   licenses/: Licenses of the components included in LAMP stack.
   frameworks/: PHP frameworks selected during the installation
   docs/: Documents for creating a custom application
   apps/
	phpMyAdmin/: Management tool for MySQL


9. CREATING AN EXAMPLE

In the doc/ folder you can find two examples to start working with
Bitnami LAMP stack. Take a look at the docs/README.txt file to know
how to create your own PHP application.


10. TROUBLESHOOTING

You can find a quick start guide and more documentation about all of the
components at:

http://docs.bitnami.com/?page=infrastructure&name=lamp

In addition to the resources provided below, we encourage you to post your
 questions and suggestions at:

https://community.bitnami.com

We also encourage you to sign up for our newsletter, which we'll use to
announce new releases and new stacks. To do so, just register at:
https://bitnami.com/newsletter. 


10.1 Installer

# Installer Payload Error

If you get the following error while trying to run the installer from the
command line:

"Installer payload initialization failed. This is likely due to an
incomplete or corrupt downloaded file" 

The installer binary is not complete, likely because the file was
not downloaded correctly. You will need to download the file and
repeat the installation process.

# Installer execution error on Linux

If you get the following error while trying to run the installer:

"Cannot open bitnami-lampstack-5.6.30-2-linux.run: No application suitable for 
automatic installation is available for handling this kind of file."

In some operatings systems you can change permissions with right click 
properties -> permissions -> execution enable.

Or from the command line:

$ chmod 755 bitnami-lampstack-5.6.30-2-linux.run 


11. LICENSES

Apache Web Server is distributed under the Apache License v2.0, which
is located at http://www.apache.org/licenses/LICENSE-2.0

MySQL is distributed under the GNU General Public License v2, which is
located at http://www.gnu.org/licenses/old-licenses/gpl-2.0.html

phpMyAdmin is distributed under the GNU General Public License v2, which is
located at http://www.gnu.org/licenses/old-licenses/gpl-2.0.html

PHP and related libraries are distributed under the PHP License v3.01,
which is located at http://www.php.net/license/3_01.txt

SQLite has been dedicated to the public domain by the authors, which is located at
http://www.sqlite.org/copyright.html

Varnish is distributed under the FreeBSD license, which is located at
https://www.varnish-cache.org/trac/browser/LICENSE

curl is distributed under the Curl License, which is located at
http://curl.haxx.se/docs/copyright.html

expat is distributed under the MIT License, which is located at
http://www.jclark.com/xml/copying.txt

gd is distributed under the gd License, which is located at
http://www.boutell.com/gd/manual2.0.33.html

IMAP is distributed under the University of Washington Free-Fork
License, located at http://www.washington.edu/imap/legal.html

jpegsrc is distributed under The Independent JPEG Group's JPEG
software license, which is located at
http://dev.w3.org/cvsweb/Amaya/libjpeg/README?rev=1.2

libiconv is distributed under the Lesser General Public License
(LGPL), located at http://www.gnu.org/copyleft/lesser.html

ImageMagick has its own license, which is located at
https://www.imagemagick.org/subversion/ImageMagick/trunk/LICENSE

OpenSSL is released under the terms of the Apache License, which is
located at http://www.openssl.org/source/license.html

Zlib is released under the zlib License (a free software license/compatible 
with GPL), which is located at http://www.gzip.org/zlib/zlib_license.html

OpenLDAP is released under OpenLDAP Public License, which is located at
http://www.openldap.org/devel/cvsweb.cgi/~checkout~//LICENSE?rev=1.24

Freetype is released under The Freetype Project License, that is located at
http://freetype.sourceforge.net/FTL.TXT

ModSecurity is released under the GNU General Public License v2, which is
located at http://www.gnu.org/licenses/old-licenses/gpl-2.0.html

 



