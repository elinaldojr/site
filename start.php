<?php

// if (substr($_SERVER['HTTP_HOST'], 0, 3) != 'www') {
//     header('HTTP/1.1 301 Moved Permanently');
//     header('Location: https://www.' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
//     exit;
// }

// if (@$_SERVER["HTTPS"] != "on") {
//     header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
//     exit();
// }

// if ($_SERVER['HTTP_HOST'] == 'www.vendania.com') {
//     header('HTTP/1.1 301 Moved Permanently');
//     header('Location: https://www.vendania.com' . $_SERVER["REQUEST_URI"]);
//     exit;
// }
///////////////////////////////////////////////////////////////////////////////////

session_start();
date_default_timezone_set("Brazil/East");

header("Content-type: text/html; charset=UTF-8");


include "config.php";
