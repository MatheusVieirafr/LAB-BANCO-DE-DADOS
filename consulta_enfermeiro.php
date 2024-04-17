<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Enfermeiros</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            text-align: center;
            color: #00008B; /* Azul escuro */
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border: 1px solid #00008B; /* Azul escuro */
            text-align: left;
        }
        th {
            background-color: #00008B; /* Azul escuro */
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2; /* Cinza claro para linhas pares */
        }
        tr:hover {
            background-color: #ddd; /* Cinza mais escuro ao passar o mouse */
        }
        a {
            color: #00008B; /* Azul escuro */
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
        <h1>Enfermeiros</h1>
        <table>
            <tr>
                <th>Matrícula</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
            <?php
                include('conexao.php');
                $sql = "SELECT * FROM enfermeiro ORDER BY nome";
                $result = mysqli_query($con, $sql) or die(mysqli_error($con)); 
                while ($reg = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $reg['matricula'] . "</td>";
                    echo "<td>" . $reg['nome'] . "</td>";
                    echo "<td><a href='editar_enfermeiro.php?matricula=" . $reg['matricula'] . "'>Editar</a> | <a href='excluir_enfermeiro.php?matricula=" . $reg['matricula'] . "'>Excluir</a></td>";
                    echo "</tr>";
                }
                mysqli_close($con);
            ?>
        </table>
    </form>
</body>
</html>
