<?php

//connect.php


 
//Our MySQL user account.
define('MYSQL_USER', 'root');
 
//Our MySQL password.
define('MYSQL_PASSWORD', '');
 
//The server that MySQL is located on.
define('MYSQL_HOST', '127.0.0.1');

//The name of our database.
define('MYSQL_DATABASE', 'noelzh');


$pdoOptions = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
);


$connect = new PDO(
    "mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DATABASE . ";charset=utf8", //DSN
    MYSQL_USER, //Username
    MYSQL_PASSWORD, //Password
    $pdoOptions //Options
);

//The PDO object can now be used to query MySQL.
?>