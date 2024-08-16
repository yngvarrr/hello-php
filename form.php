<?php
if (isset($_POST['submit'])) {

  include_once('index.php');

  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $telefone = $_POST['telefone'];
  $cpf = $_POST['cpf'];
  $data_nasc = $_POST['data_nascimento'];

  function validarNome($nome)
  {
    if (strlen($nome) < 3) {
      echo "<script>alert('O nome deve ter pelo menos 3 letras.');</script>";
      return false;
    }
    return true;
  }

  $sqlCheck = "SELECT id FROM clientes WHERE telefone = '$telefone'";
  $resultCheck = mysqli_query($conn, $sqlCheck);

  if (mysqli_num_rows($resultCheck) > 0) {
    echo "<script>alert('Este telefone já está registrado.');</script>";
    echo "<script>window.history.back();</script>";
    exit();
  }

  if (validarNome($nome)) {
    $sqlInsert = "INSERT INTO clientes(nome,email,telefone,cpf,data_nasc) VALUES ('$nome','$email','$telefone','$cpf','$data_nasc')";
    $resultInsert = mysqli_query($conn, $sqlInsert);

    if ($resultInsert) {
      echo "<script>alert('Cadastro realizado com sucesso!');</script>";
      header("Location: sistema.php");
      exit();
    } else {
      echo "<script>alert('Erro ao cadastrar.');</script>";
    }
  } else {
    echo "<script>window.history.back();</script>";
    exit();
  }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Formulário de Cadastro</title>
  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
      background-image: linear-gradient(to right,
          rgb(20, 147, 220),
          rgb(17, 54, 71));
    }

    .box {
      color: white;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: rgba(0, 0, 0, 0.6);
      padding: 15px;
      border-radius: 15px;
      width: 20%;
    }

    fieldset {
      border: 3px solid dodgerblue;
    }

    legend {
      border: 1px solid dodgerblue;
      padding: 10px;
      text-align: center;
      background-color: dodgerblue;
      border-radius: 8px;
    }

    .inputBox {
      position: relative;
    }

    .inputUser {
      background: none;
      border: none;
      border-bottom: 1px solid white;
      outline: none;
      color: white;
      font-size: 15px;
      width: 100%;
      letter-spacing: 2px;
    }

    .labelInput {
      position: absolute;
      top: 0px;
      left: 0px;
      pointer-events: none;
      transition: 0.5s;
    }

    .inputUser:focus~.labelInput,
    .inputUser:valid~.labelInput {
      top: -20px;
      font-size: 12px;
      color: dodgerblue;
    }

    .disclaimer {
      font-size: 14px;
      text-align: center;
      font-weight: bold;
    }

    #data_nascimento {
      border: none;
      padding: 8px;
      border-radius: 10px;
      outline: none;
      font-size: 15px;
    }

    #submit {
      background-image: linear-gradient(to right,
          rgb(0, 92, 197),
          rgb(90, 20, 220));
      width: 100%;
      border: none;
      padding: 15px;
      color: white;
      font-size: 15px;
      cursor: pointer;
      border-radius: 10px;
    }

    #submit:hover {
      background-image: linear-gradient(to right,
          rgb(0, 80, 172),
          rgb(80, 19, 195));
    }
  </style>
</head>

<body>
  <div class="box">
    <form action="form.php" method="POST" onsubmit="return validarNome()">
      <fieldset>
        <legend><b>Fórmulário de Cadastro</b></legend>
        <br />
        <div class="inputBox">
          <input type="text" name="nome" id="nome" class="inputUser" required />
          <label for="nome" class="labelInput">Nome completo*</label>
        </div>
        <br /><br />
        <div class="inputBox">
          <input type="tel" name="telefone" id="telefone" class="inputUser" required maxlength="11" />
          <label for="telefone" class="labelInput">Telefone*</label>
        </div>
        <br /><br />
        <label for="data_nascimento"><b>Data de Nascimento:*</b></label>
        <input type="date" name="data_nascimento" id="data_nascimento" required />
        <br /><br /><br />
        <div class="inputBox">
          <input type="text" name="cpf" id="cpf" class="inputUser" maxlength="11" />
          <label for="cidade" class="labelInput">CPF</label>
        </div>
        <br /><br />
        <div class="inputBox">
          <input type="text" name="email" id="email" class="inputUser" />
          <label for="email" class="labelInput">Email</label>
        </div>
        <p class="disclaimer">Campos com * são obrigatórios</p>
        <input type="submit" name="submit" id="submit" />
      </fieldset>
    </form>
  </div>
</body>

</html>