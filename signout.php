<?php
session_start();

$referer = $_SERVER['HTTP_REFERER'];
if(strpos($referer, '?') !== false){
  $referer = strstr($referer, '?', true);
}


$_SESSION = [];

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_destroy();



header("Location: top.php" . "?from=logout");
exit();
