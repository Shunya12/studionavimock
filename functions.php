<?php
    function flash($type, $message)
    {
        global $flash;
        $_SESSION['flash'][$type] = $message;
        $flash[$type] = $message;
    }
?>