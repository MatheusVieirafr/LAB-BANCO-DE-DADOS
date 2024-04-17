<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Consulta, Edição e Exclusão de Pacientes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0ebeb; /* Rosa claro */
            margin: 0;
            padding: 0;
        }

        h1 {
            color: #ff69b4; /* Rosa */
            text-align: center;
            margin-top: 20px;
        }

        table {
            width: 95%; /* Reduzindo o tamanho da tabela para 95% da largura da tela */
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff; /* Branco */
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ccc;
            white-space: nowrap; /* Evita que os registros sejam quebrados */
            overflow: hidden; /* Oculta conteúdo extra */
            text-overflow: ellipsis; /* Adiciona reticências quando o conteúdo não cabe */
        }

        th {
            background-color: #ffccde; /* Rosa claro */
            color: #ff69b4; /* Rosa */
        }

        tr:nth-child(even) {
            background-color: #fff; /* Branco */
        }

        a {
            color: #ff69b4; /* Rosa */
            text-decoration: none;
            transition: color 0.3s;
        }

        a:hover {
            color: #d94d86; /* Rosa mais escuro */
        }
    </style>
</head>
<body>
<h1>Consulta, Edição e Exclusão de Pacientes</h1>
<table border="1">
    <tr>
        <th style="width: 10%;">Nome</th>
        <th style="width: 10%;">Endereço</th>
        <th style="width: 5%;">Número</th>
        <th style="width: 10%;">Complemento</th>
        <th style="width: 10%;">Bairro</th>
        <th style="width: 10%;">Cidade</th>
        <th style="width: 5%;">Estado</th>
        <th style="width: 10%;">CPF</th>
        <th style="width: 5%;">RG</th>
        <th style="width: 8%;">Telefone</th>
        <th style="width: 8%;">Celular</th>
        <th style="width: 10%;">Email</th>
        <th style="width: 9%;">Ações</th>
    </tr>
    <?php
    include('conexao.php');
    $query = "SELECT * FROM paciente";
    $resultado = mysqli_query($con, $query) or die(mysqli_connect_error());
    while ($registro = mysqli_fetch_array($resultado)) {
        echo "<tr>";
        echo "<td>" . $registro['nome'] . "</td>";
        echo "<td>" . $registro['endereco'] . "</td>";
        echo "<td>" . $registro['numero'] . "</td>";
        echo "<td>" . $registro['complemento'] . "</td>";
        echo "<td>" . $registro['bairro'] . "</td>";
        echo "<td>" . $registro['cidade'] . "</td>";
        echo "<td>" . $registro['estado'] . "</td>";
        echo "<td>" . $registro['cpf'] . "</td>";
        echo "<td>" . $registro['rg'] . "</td>";
        echo "<td>" . $registro['telefone'] . "</td>";
        echo "<td>" . $registro['celular'] . "</td>";
        echo "<td>" . $registro['email'] . "</td>";
        echo "<td><a href='alter_paciente.php?id=" . $registro['id'] . "'>Editar</a> | <a href='excluir_paciente.php?id=" . $registro['id'] . "'>Excluir</a></td>";
        echo "</tr>";
    }
    mysqli_close($con);
    ?>
</table>
</body>
</html>
