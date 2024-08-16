<?php

include_once('index.php');

if (isset($_POST['update'])) {
    $id = $_POST['id'];

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $cpf = $_POST['cpf'];
    $data_nasc = $_POST['data_nascimento'];

    $sqlUpdate = "UPDATE clientes 
                  SET nome='$nome', email='$email', telefone='$telefone', cpf='$cpf', data_nasc='$data_nasc'
                  WHERE id=$id";

    $result = $conn->query($sqlUpdate);

    if ($result === TRUE) {
        echo "<script>alert('Dados atualizados com sucesso!');</script>";
    } else {
        echo "<script>alert('Erro ao atualizar os dados: " . $conn->error . "');</script>";
    }

    header('Location: sistema.php');
    exit();
}
?>