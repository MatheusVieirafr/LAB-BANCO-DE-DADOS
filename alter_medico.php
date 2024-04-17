<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Médicos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        h1 {
            color: green; /* Título em verde */
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: green; /* Fundo das células do cabeçalho em verde */
            color: white; /* Cor do texto do cabeçalho em branco */
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        a {
            color: green; /* Links em verde */
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<?php
if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>
<form method="POST" action="">
    <h1>Médicos</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th colspan="2">Ações</th>
        </tr>
        <?php
        include('conexao.php');
        $sql = "SELECT * FROM medico ORDER BY nome";
        $resu = mysqli_query($con, $sql) or die(mysqli_connect_error());

        while ($reg = mysqli_fetch_array($resu)) {
            echo "<tr>";
            echo "<td>" . $reg['id_medico'] . "</td>";
            echo "<td>" . $reg['nome'] . "</td>";
            echo "<td><a href='edit_medico.php?id_medico=" . $reg['id_medico'] . "'>Editar</a></td>";
            echo "<td><a href='del_medico.php?id_medico=" . $reg['id_medico'] . "'>Excluir</a></td>";
            echo "</tr>";
        }
        mysqli_close($con);
        ?>
    </table>
</form>
</body>
</html>
