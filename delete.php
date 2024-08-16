<?php

if (!empty($_GET['id'])) {
    include_once('index.php');

    $id = $_GET['id'];

    $sqlSelect = "SELECT *  FROM clientes WHERE id=$id";

    $result = $conn->query($sqlSelect);

    if ($result->num_rows > 0) {
        $sqlDelete = "DELETE FROM clientes WHERE id=$id";
        $resultDelete = $conn->query($sqlDelete);
    }
}

header('Location: sistema.php');

?>