<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Funções médicas</title>
    <style>
        body {
            background-color: orange;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        h1 {
            color: white;
            background-color: orange;
            padding: 10px;
            text-align: center;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: darkorange;
            color: white;
            border-top: none; /* Remover a borda superior */
        }
        td {
            background-color: lightgoldenrodyellow;
        }
        a {
            color: black;
            text-decoration: none;
        }
        a:hover {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Funções dos Enfermeiros</h1>
    <table>
        <tr>
            <th>Descrição</th>
            <th colspan="2">Ações</th>
        </tr>
        <?php
            include('conexao.php');
            $query = "SELECT * FROM funcao ORDER BY descricao";
            $resul = mysqli_query($con, $query) or die(mysqli_connect_error());
            while ($reg = mysqli_fetch_array($resul)) {
                echo "<tr>";
                echo "<td>" . $reg['descricao'] . "</td>";
                echo "<td><a href='alterar_funcao.php?id=" . $reg['id'] . "'>Editar</a></td>";
                echo "<td><a href='excluir_funcao.php?id=" . $reg['id'] . "'>Excluir</a></td>";
                echo "</tr>";
            }
            mysqli_close($con);
        ?>
    </table>
    <form method="POST">
        <!-- Aqui você pode adicionar elementos ao formulário se necessário -->
    </form>
</body>
</html>
