<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//https://stackoverflow.com/questions/4356289/php-random-string-generator/31107425#31107425

function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
{
    $pieces = [];
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $pieces []= $keyspace[random_int(0, $max)];
    }
    return implode('', $pieces);
}

function create_csrf_token() {
    $_SESSION['csrf'] = random_str(123);
    header("Set-Cookie: csrf=".$_SESSION['csrf']."; path=/; time=0; sameSite=Strict");
}

function check_csrf_token() {
    if (!isset($_SESSION['csrf'])) exit("no csrf token created");
    if (!isset($_COOKIE['csrf'])) exit("no csrf token in coockies");
    return $_SESSION['csrf'] === $_COOKIE['csrf'];
}

function create_csrf_field() {
    //if (!isset($_SESSION['csrf'])) create_csrf_token();
    //echo '<input type="hidden" name="_csrf" value="'.$_SESSION['csrf'].'"></input>';
}

?>