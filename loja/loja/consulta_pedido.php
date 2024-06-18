<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Consulta de Pedidos</title>
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
    <h1>Consulta de Pedidos</h1>

    
    <div class="search-form">
        <form method="GET">
            <label for="data_inicio">Data Início:</label>
            <input type="date" id="data_inicio" name="data_inicio">
            <label for="data_fim">Data Fim:</label>
            <input type="date" id="data_fim" name="data_fim">
            <input type="submit" value="Filtrar">
        </form>
    </div>

    <div class="export-button">
        <form action="relatorio_pedidos.php" method="post" target="_blank">
            <input type="submit" value="Exportar Pedidos em PDF">
        </form>
    </div>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Data</th>
            <th>ID Cliente</th>
            <th>Nome Cliente</th>
            <th>Observação</th>
            <th>Forma de Pagamento</th>
            <th>Prazo de Entrega</th>
            <th>Ações</th>
        </tr>

        <?php
        include('conexao.php');

        $condition = "";
        if (isset($_GET['data_inicio'], $_GET['data_fim'])) {
            $data_inicio = mysqli_real_escape_string($con, $_GET['data_inicio']);
            $data_fim = mysqli_real_escape_string($con, $_GET['data_fim']);
            $condition = "WHERE data BETWEEN '$data_inicio' AND '$data_fim'";
        }

        $query = "SELECT p.id, p.data, p.id_cliente, c.nome AS nome_cliente, p.observacao, p.forma_pagto, p.prazo_entrega
                  FROM pedidos p
                  LEFT JOIN clientes c ON p.id_cliente = c.id
                  $condition
                  ORDER BY p.data DESC";
        $result = mysqli_query($con, $query) or die(mysqli_connect_error());

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['data'] . "</td>";
            echo "<td>" . $row['id_cliente'] . "</td>";
            echo "<td>" . $row['nome_cliente'] . "</td>";
            echo "<td>" . $row['observacao'] . "</td>";
            echo "<td>" . $row['forma_pagto'] . "</td>";
            echo "<td>" . $row['prazo_entrega'] . "</td>";
            echo "<td><a href='excluir_pedidos.php?id=" . $row['id'] . "'>Excluir</a></td>";
            echo "</tr>";
        }

        mysqli_close($con);
        ?>

    </table>
</body>
</html>
