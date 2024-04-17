<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Especialidades médicas</title>
        <style>
            body {
                background-color: #f2f2f2;
                font-family: Arial, sans-serif;
            }
            h1 {
                color: purple;
                text-align: center;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }
            th, td {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }
            th {
                background-color: #f2f2f2;
            }
            a {
                color: purple;
                text-decoration: none;
            }
            a:hover {
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <h1>Especialidades médicas</h1>
        <table>
            <?php
                include('conexao.php');
                $query="Select * from especialidade ORDER BY descricao";
                $resu=mysqli_query($con, $query) or die(mysqli_connect_error());
                echo "<tr><th>Descrição</th><th>Sigla</th><th colspan='2'>Ações</th></tr>";
                while ($reg = mysqli_fetch_array($resu)) {
                    echo "<tr><td>" . $reg['descricao'] . "</td>";
                    echo "<td>" . $reg['sigla'] . "</td>";
                    echo "<td><a href='alterar_especialidade.php?id=" . $reg['id'] . "'>Editar</a></td>";
                    echo "<td><a href='excluir_especialidade.php?id=" . $reg['id'] . "'>Excluir</a></td></tr>";     
                }
                mysqli_close($con);
            ?>
        </table>
    </body>
</html>
