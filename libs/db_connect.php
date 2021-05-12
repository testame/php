<?php
    /*
    $host = "casadecarli.ddns.net";
    $db_name = "dbpoldo";
    $username = "ut17828";
    $password = "pw17828";
    */
    $host = "localhost";
    $db_name = "dbpoldo";
    $username = "poldo";
    $password = "poldo";

    try {
        $con = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password,array(PDO::ATTR_PERSISTENT => true));
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $exception){
        echo "Connection error: " . $exception->getMessage();
    }
?>
