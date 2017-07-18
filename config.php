<?php
/**
 * Created by PhpStorm.
 * User: Faridho
 * Date: 7/18/2017
 * Time: 6:42 AM
 */

function getDB(){
    $dbhost    = "localhost";
    $dbuser    = "root";
    $dbpass    = "";
    $dbname    = "db_login";

    $dbconnect = new PDO("mysql:host=$dbhost; dbname=$dbname", $dbuser, $dbpass);
    $dbconnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbconnect;
}