<?php
/**
 * Created by PhpStorm.
 * User: zedd
 * Date: 2018-12-14
 * Time: 02:55
 */
setcookie ( "username", "", time () + 60 * 60 * 24 * 30 );
setcookie ( "id", "", time () + 60 * 60 * 24 * 30 );
setcookie ( "role", "", time () + 60 * 60 * 24 * 30 );
setcookie ( "token", "", time () + 60 * 60 * 24 * 30 );
header('location:./login.php');
?>