# Slim Framework 3 Skeleton Application

Use this skeleton application to quickly setup and start working on a new Slim Framework 3 application. This application uses the latest Slim 3 with the PHP-View template renderer. It also uses the Monolog logger.

This skeleton application was built for Composer. This makes setting up a new Slim Framework application quick and easy.

## Install the Application

Run this command from the directory in which you want to install your new Slim Framework application.

    php composer.phar create-project slim/slim-skeleton [my-app-name]

Replace `[my-app-name]` with the desired directory name for your new application. You'll want to:

* Point your virtual host document root to your new application's `public/` directory.
* Ensure `logs/` is web writeable.

To run the application in development, you can also run this command. 

	php composer.phar start

Run this command to run the test suite

	php composer.phar test

That's it! Now go build something cool.

#start host > php -S 0.0.0.0:8080 -t public public/index.php
#composer start

#doc
> https://www.slimframework.com/docs/features/csrf.html
> https://github.com/slimphp/Slim-Csrf/blob/master/README.md

#Twik
> https://www.slimframework.com/docs/features/templates.html
> composer require slim/twig-view

> composer require slim/csrf
> composer require illuminate/database "~5.1"

#ng production
> ng build --prod --aot
> ng serve --prod --aot

#build
$ ng build --environment=production
#shorthand
$ ng b -prod

#serve
$ ng serve --environment=production
#shorthand
$ ng s -prod

// ORM
https://graeson.wordpress.com/2014/06/27/laravel-eloquent-orm-2/