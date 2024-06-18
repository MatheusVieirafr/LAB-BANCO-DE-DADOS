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
    <h1>Consulta de itens pedido Pedidos</h1>

    <div class="search-form">
        <form method="GET">
            <label for="nome_cliente">Nome do Cliente:</label>
            <input type="text" id="nome_cliente" name="nome_cliente">
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
            <th>Número do Pedido</th>
            <th>Data</th>
            <th>Nome do Cliente</th>
            <th>Nome do Vendedor</th>
            <th>Produto</th>
            <th>Preço</th>
            <th>Quantidade</th>
            <th>Ações</th>
        </tr>

        <?php
    
        include('conexao.php');


        $condition = "";


        if (isset($_GET['nome_cliente']) && !empty($_GET['nome_cliente'])) {
            $nome_cliente = mysqli_real_escape_string($con, $_GET['nome_cliente']);
            $condition .= " WHERE c.nome LIKE '%$nome_cliente%'";
        }

        $query = "SELECT p.id AS numero_pedido, p.data, c.nome AS nome_cliente, v.nome AS nome_vendedor, pr.nome AS produto, pr.preco, ip.qtde AS quantidade
                  FROM pedidos p
                  LEFT JOIN clientes c ON p.id_cliente = c.id
                  LEFT JOIN vendedor v ON p.id_vendedor = v.id
                  LEFT JOIN itens_pedido ip ON p.id = ip.id_pedido
                  LEFT JOIN produto pr ON ip.id_produto = pr.id
                  $condition
                  ORDER BY p.data DESC";

        $result = mysqli_query($con, $query) or die(mysqli_error($con));


        if (mysqli_num_rows($result) > 0) {
      
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['numero_pedido'] . "</td>";
                echo "<td>" . $row['data'] . "</td>";
                echo "<td>" . $row['nome_cliente'] . "</td>";
                echo "<td>" . $row['nome_vendedor'] . "</td>";
                echo "<td>" . $row['produto'] . "</td>";
                echo "<td>" . $row['preco'] . "</td>";
                echo "<td>" . $row['quantidade'] . "</td>";
                echo "<td><a href='excluir_pedidos.php?id=" . $row['numero_pedido'] . "'>Excluir</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>Nenhum pedido encontrado.</td></tr>";
        }

        mysqli_close($con);
        ?>

    </table>

  
</body>
</html>
