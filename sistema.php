<?php
include_once('index.php');

if (!empty($_GET['search'])) {

    $data = $_GET['search'];
    $sql = "SELECT * FROM clientes WHERE id LIKE '%$data%' or nome LIKE '%$data%' or email LIKE '%$data%' ORDER BY id ASC";
} else {
    $sql = "SELECT * FROM clientes ORDER BY id ASC";
}
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banco de Cadastros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-image: linear-gradient(to right,
                    rgb(20, 147, 220),
                    rgb(17, 54, 71));
        }

        .table-bg {
            background: rgba(0, 0, 0, 0.3);
            border-radius: 15px 15px 0 0;
        }

        .head {
            text-align: center;
            font-weight: bold;
            color: white;
        }

        .navbar {
            margin: auto 10px;
        }

        .navbar h1 {
            color: white;
            font-weight: bold;
        }

        .navbar button {
            background-color: crimson;
            color: white;
            border-radius: 15px;
            padding: 10px;
        }

        .box-search {
            display: flex;
            justify-content: center;
            gap: .1%;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div>
            <h1>Sistema</h1>
        </div>
        <button onclick="window.location.href='form.php';">Voltar para cadastro</button>
    </nav>
    <div class="m-5">
        <h1 class="head">Clientes Cadastrados</h1>
        <div class="box-search">
            <input type="search" class="form-control w-25" placeholder="Pesquisar" id="pesquisar">
            <button onclick="searchData()" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search"
                    viewBox="0 0 16 16">
                    <path
                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                </svg>
            </button>
        </div>
        <div>
            <table class="table text-white table-bg">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Data de Nascimento</th>
                        <th scope="col">CPF</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    function formatar_telefone($telefone)
                    {
                        $telefone = preg_replace('/\D/', '', $telefone);
                        return '(' . substr($telefone, 0, 2) . ') '
                            . substr($telefone, 2, 5) . '-'
                            . substr($telefone, 7);
                    }

                    function formatar_cpf($cpf)
                    {
                        $cpf = preg_replace('/\D/', '', $cpf);
                        if (strlen($cpf) == 11) {
                            return substr($cpf, 0, 3) . '.' .
                                substr($cpf, 3, 3) . '.' .
                                substr($cpf, 6, 3) . '-' .
                                substr($cpf, 9, 2);
                        }

                        return $cpf;
                    }

                    function formatar_data($data)
                    {
                        $date = new DateTime($data);
                        return $date->format('d-m-Y');
                    }

                    while ($user_data = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $user_data['id'] . "</td>";
                        echo "<td>" . $user_data['nome'] . "</td>";
                        $telefone_formatado = formatar_telefone($user_data['telefone']);
                        echo "<td>" . htmlspecialchars($telefone_formatado) . "</td>";
                        $data_formatada = formatar_data($user_data['data_nasc']);
                        echo "<td>" . htmlspecialchars($data_formatada) . "</td>";
                        $cpf = !empty($user_data['cpf']) ? formatar_cpf($user_data['cpf']) : '<strong>Não informado</strong>';
                        echo "<td>" . $cpf . "</td>";
                        $email = !empty($user_data['email']) ? "<a target='_blank' href='mailto:" . htmlspecialchars($user_data['email']) . "'>" . htmlspecialchars($user_data['email']) . "</a>" : '<strong>Não informado</strong>';
                        echo "<td>" . $email . "</td>";
                        echo "<td>
                        <a class='btn btn-sm btn-primary' href='edit.php?id=$user_data[id]' title='Editar'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                                <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/>
                            </svg>
                            </a> 
                            <a class='btn btn-sm btn-danger' href='delete.php?id=$user_data[id]' title='Deletar'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                    <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                                </svg>
                            </a>
                            </td>";
                        echo "</tr>";
                    }

                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
<script>
    var search = document.getElementById('pesquisar');

    search.addEventListener("keydown", function (event) {
        if (event.key === "Enter") {
            searchData();
        }
    });

    function searchData() {
        window.location = 'sistema.php?search=' + search.value;
    }
</script>

</html>