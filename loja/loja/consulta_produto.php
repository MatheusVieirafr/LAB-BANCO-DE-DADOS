<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Consulta de Produto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 20px;
            padding: 20px;
        }

        h1 {
            text-align: left;
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

        .search-form {
            margin-bottom: 20px;
            text-align: left;
        }

        .search-form label {
            font-weight: bold;
        }

        .search-form input[type="text"] {
            padding: 8px;
            width: 250px;
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
    <h1>Consulta de Produto</h1>

    <div class="search-form">
        <form method="GET">
            <label for="search">Filtrar por nome:</label>
            <input type="text" id="search" name="search">
            <input type="submit" value="Filtrar">
        </form>
    </div>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Ações</th>
        </tr>

        <?php
        include('conexao.php');

        $condition = "";
        if (isset($_GET['search']) && !empty($_GET['search'])) {
            $search = mysqli_real_escape_string($con, $_GET['search']);
            $condition = "WHERE nome LIKE '%$search%'";
        }

        $query = "SELECT * FROM produto $condition ORDER BY nome";
        $result = mysqli_query($con, $query) or die(mysqli_connect_error());

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['nome'] . "</td>";
            echo "<td><a href='alterar_produto.php?id=" . $row['id'] . "'>Editar</a> | <a href='excluir_produto.php?id=" . $row['id'] . "'>Excluir</a></td>";
            echo "</tr>";
        }

        mysqli_close($con);
        ?>

    </table>
</body>
</html>
