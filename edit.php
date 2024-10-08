<?php
include_once('index.php');

if (!empty($_GET['id'])) {

  $id = $_GET['id'];

  $sqlSelect = "SELECT * FROM clientes WHERE id=$id";

  $result = $conn->query($sqlSelect);

  if ($result->num_rows > 0) {

    while ($user_data = mysqli_fetch_assoc($result)) {
      $nome = $user_data['nome'];
      $telefone = $user_data['telefone'];
      $data_nasc = $user_data['data_nasc'];
      $cpf = $user_data['cpf'];
      $email = $user_data['email'];
    }
  }
} else {
  header('Location: sistema.php');
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

    .container {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin: 10px auto;
    }

    .disclaimer {
      font-size: 14px;
      text-align: center;
      font-weight: bold;
    }

    .link {
      color: white;
      font-weight: bold;
    }

    #data_nascimento {
      border: none;
      padding: 8px;
      border-radius: 10px;
      outline: none;
      font-size: 15px;
    }

    #update {
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

    #update:hover {
      background-image: linear-gradient(to right,
          rgb(0, 80, 172),
          rgb(80, 19, 195));
    }
  </style>
</head>

<body>
  <div class="box">
    <form action="saveEdit.php" method="POST">
      <fieldset>
        <legend><b>Fórmulário de Cadastro</b></legend>
        <br />
        <div class="inputBox">
          <input type="text" name="nome" id="nome" class="inputUser" value="<?php echo $nome ?>" required />
          <label for="nome" class="labelInput">Nome completo*</label>
        </div>
        <br /><br />
        <div class="inputBox">
          <input type="tel" name="telefone" id="telefone" class="inputUser" value="<?php echo $telefone ?>" required
            maxlength="11" />
          <label for="telefone" class="labelInput">Telefone*</label>
        </div>
        <br /><br />
        <label for="data_nascimento"><b>Data de Nascimento:*</b></label>
        <input type="date" name="data_nascimento" id="data_nascimento" required value="<?php echo $data_nasc ?>" />
        <br /><br /><br />
        <div class="inputBox">
          <input type="text" name="cpf" id="cpf" class="inputUser" maxlength="11" value="<?php echo $cpf ?>" />
          <label for="cidade" class="labelInput">CPF</label>
        </div>
        <br /><br />
        <div class="inputBox">
          <input type="text" name="email" id="email" class="inputUser" value="<?php echo $email ?>" />
          <label for="email" class="labelInput">Email</label>
        </div>
        <div class="container">
          <p class="disclaimer">Campos com * são obrigatórios</p>
          <a class="link" href="sistema.php">Voltar ao sistema</a>
        </div>
        <input type="hidden" name="id" value=<?php echo $id; ?>>
        <input type="submit" name="update" id="update">
      </fieldset>
    </form>
  </div>
</body>

</html>