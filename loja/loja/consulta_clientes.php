<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Consulta de Clientes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 20px;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border: 1px solid #ccc;
        }

        table th, table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        table td a {
            text-decoration: none;
            color: #333;
            padding: 4px 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        table td a:hover {
            background-color: #4CAF50;
            color: white;
        }

        .export-button {
            text-align: left; 
            margin-bottom: 20px;
        }

        .export-button input[type="submit"] {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #008CBA;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        .export-button input[type="submit"]:hover {
            background-color: #005f6b;
        }

        .search-form {
            margin-bottom: 20px;
            text-align: left;
        }

        .search-form label {
            font-weight: bold;
            margin-right: 10px;
        }

        .search-form input[type="date"] {
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        .search-form input[type="submit"] {
            padding: 8px 20px;
            border: none;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            border-radius: 4px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <h1>Consulta de Clientes</h1>

   
    <form method="POST" action="">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo isset($_POST['nome']) ? $_POST['nome'] : ''; ?>">
        <label for="cidade">Cidade:</label>
        <input type="text" id="cidade" name="cidade" value="<?php echo isset($_POST['cidade']) ? $_POST['cidade'] : ''; ?>">
        <input type="submit" value="Filtrar">
    </form>

   
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Endereço</th>
            <th>Número</th>
            <th>Bairro</th>
            <th>Cidade</th>
            <th>Estado</th>
            <th>Email</th>
            <th>CPF/CNPJ</th>
            <th>RG</th>
            <th>Telefone</th>
            <th>Celular</th>
            <th>Data de Nascimento</th>
            <th>Salário</th>
            <th>Ações</th>
        </tr>

        <?php
        include('conexao.php');

        $query = "SELECT * FROM clientes";

        $conditions = array();
        if (!empty($_POST['nome'])) {
            $nome = mysqli_real_escape_string($con, $_POST['nome']);
            $conditions[] = "nome LIKE '%$nome%'";
        }
        if (!empty($_POST['cidade'])) {
            $cidade = mysqli_real_escape_string($con, $_POST['cidade']);
            $conditions[] = "cidade LIKE '%$cidade%'";
        }
        if (count($conditions) > 0) {
            $query .= " WHERE " . implode(' AND ', $conditions);
        }

        $query .= " ORDER BY nome";

        $result = mysqli_query($con, $query) or die(mysqli_connect_error());
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['nome'] . "</td>";
            echo "<td>" . $row['endereco'] . "</td>";
            echo "<td>" . $row['numero'] . "</td>";
            echo "<td>" . $row['bairro'] . "</td>";
            echo "<td>" . $row['cidade'] . "</td>";
            echo "<td>" . $row['estado'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['cpf_cnpj'] . "</td>";
            echo "<td>" . $row['rg'] . "</td>";
            echo "<td>" . $row['telefone'] . "</td>";
            echo "<td>" . $row['celular'] . "</td>";
            echo "<td>" . $row['data_nasc'] . "</td>";
            echo "<td>" . $row['salario'] . "</td>";

            echo "<td><a href='alterar_clientes.php?id=" . $row['id'] . "'>Editar</a> | 
            <a href='excluir_clientes.php?id=" . $row['id'] . "'>Excluir</a></td>";
            
            echo "</tr>";
        }
        mysqli_close($con);
        ?>
    </table>
</body>
</html>
