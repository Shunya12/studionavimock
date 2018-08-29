<?php
    $dsn = 'mysql:dbname=studioNAVI;host=localhost';
    $user = 'root';
    $password='batch44';
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->query('SET NAMES utf8');
?>