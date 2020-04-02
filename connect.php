<?php
    $username = "root";
    $servername = "localhost";
    $password = "";
    $db = "db_croit";

    $connect = mysqli_connect($servername, $username, $password, $db);

    if(!$connect){
        die("Connection failed. Please contact administrator. Email: mihaita_nicolaescu@yahoo.com");
    }

    ?>