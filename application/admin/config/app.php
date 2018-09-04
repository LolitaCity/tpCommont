<?php
$app    = include ("/home/www_php/config/tp5/home/www_php/config/tp5/app.php");
$cache  = include ("/home/www_php/config/tp5/home/www_php/config/tp5/cache.php");
$console= include ("/home/www_php/config/tp5/home/www_php/config/tp5/sonsole.php");
$cookie = include ("/home/www_php/config/tp5/home/www_php/config/tp5/cookie.php");
$databases  = include ("/home/www_php/config/tp5/home/www_php/config/tp5/databases.php");
$log        = include ("/home/www_php/config/tp5/home/www_php/config/tp5/log.php");
$middleware = include ("/home/www_php/config/tp5/home/www_php/config/tp5/middleware.php");
$session    = include ("/home/www_php/config/tp5/home/www_php/config/tp5/session.php");
$template   = include ("/home/www_php/config/tp5/home/www_php/config/tp5/template.php");
$trace      = include ("/home/www_php/config/tp5/home/www_php/config/tp5/trace.php");
$config     = include ("/home/www_php/config/tp5/home/www_php/config/tp5/config.php");


return array_merge($app,$cache,$console,$cookie,$databases,$log,$middleware,$session,$template,$trace,$config);