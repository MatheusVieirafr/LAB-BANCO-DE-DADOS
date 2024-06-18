<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Consulta de Formas de Pagamento</title>
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
    </style>
</head>
<body>
    <h1>Consulta de Formas de Pagamento</h1>

    <table border="1">
        <tr>
            <th>Descrição</th>
            <th>Ações</th>
        </tr>

        <?php
        include('conexao.php');

        $query = "SELECT * FROM forma_pagto ORDER BY nome";
        $result = mysqli_query($con, $query) or die(mysqli_connect_error());

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['nome'] . "</td>";
            echo "<td><a href='alterar_forma_pagto.php?id=" . $row['id'] . "'>Editar</a> | ";
            echo "<a href='excluir_forma_pagto.php?id=" . $row['id'] . "'>Excluir</a></td>";
            echo "</tr>";
        }

        mysqli_close($con);
        ?>
    </table>
</body>
</html>
