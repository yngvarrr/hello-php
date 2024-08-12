<?php

$host = 'localhost:3306'; 
$dbuser = 'root';
$dbpassword = 'root';
$dbname = 'visu_clientes';

$conn = mysqli_connect($host,$dbuser,$dbpassword,$dbname);
if($conn){
    mysqli_query($conn,'SELECT COUNT(1) AS total FROM `clientes`;');
    echo "Connection - successful </br>";
}
else {
    echo "Connection - failed </br>" . mysqli_connect_error();
}

