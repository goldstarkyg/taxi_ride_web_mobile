This folder contains two examples for this Stack.

1. PHPINFO EXAMPLE

The first one is the "phpinfo.php" script which shows information 
about the current state of PHP. If you want to know the current
PHP configuration you can copy this file to the following folder:

/opt/bitnami/apache2/htdocs

This is the document root folder for Apache. You can also find the Bitnami
Welcome page into it.

Then go to your browser at http://localhost:80/phpinfo.php
and you will see the current PHP configuration.


2. APPLICATION EXAMPLE

The second example allows you to create the same structure as all Bitnami 
applications. This structure allows you create your own application that
will be accessible at http://localhost:80/demo

You should copy the "demo" folder into the /opt/bitnami/apps 
folder and add the following line at the end of the
/opt/bitnami/apache2/conf/bitnami/bitnami-apps-prefix.conf

Include "/opt/bitnami/apps/demo/conf/httpd-prefix.conf"

Then restart the Apache server. You can use the graphical Manager tool 
that you can find in your installation directory.

Go to your browser at http://localhost:80/demo and
you will see a "Hello world" page.

3. VIRTUAL HOST EXAMPLE

The demo application can also be configured in a Virtual Host. In this case
you can run your application at http://demo.example.com or any custom domain.

To enable Virtual Host configuration, you only have to disable the previous
configuration in the "/opt/bitnami/apache2/conf/bitnami/bitnami-apps-prefix.conf" file

#Include "/opt/bitnami/apps/demo/conf/httpd-prefix.conf"

and enable the new Virtual Host configuration file in the 
"/opt/bitnami/apache2/conf/bitnami/bitnami-apps-vhosts.conf" file:

Include "/opt/bitnami/apps/demo/conf/httpd-vhosts.conf"

Then restart Apache server and try to access at http://demo.example.com

IMPORTANT: Virtual Host configuration requires that the domain name points to the
server IP address. If you are testing this configuration, you can add a new entry
in the "hosts" file in your system.

You can find more info about creating your custom PHP application at:

https://docs.bitnami.com/general/components/php/#how-to-create-a-custom-php-application

