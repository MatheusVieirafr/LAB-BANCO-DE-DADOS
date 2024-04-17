<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Exclusão de Médico</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        h1 {
            color: green;
            text-align: center;
            margin-top: 20px;
        }

        form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: green;
        }

        input[type="text"] {
            width: calc(100% - 10px);
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"],
        input[type="reset"] {
            width: 49%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"] {
            background-color: green;
            color: white;
        }

        input[type="reset"] {
            background-color: #ccc;
            color: black;
        }

        input[type="submit"]:hover {
            background-color: darkgreen;
        }

        input[type="reset"]:hover {
            background-color: #999;
        }

        p {
            color: green;
        }
    </style>
</head>
<body>
<h1>Exclusão de Médico</h1>
<?php

if (isset($_GET['id_medico'])) {

    include('conexao.php');

    $id_medico = $_GET['id_medico'];

    $query = "SELECT * FROM medico WHERE id_medico = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "i", $id_medico);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $row = mysqli_fetch_assoc($result);

    if ($row) {
        ?>
        <form method="POST">
            <input type="hidden" name="id_medico" value="<?php echo $row['id_medico']; ?>">
            <label>Nome:</label>
            <input type="text" value="<?php echo $row['nome']; ?>" readonly>
            <label>CPF:</label>
            <input type="text" value="<?php echo $row['cpf']; ?>" readonly>
            <p>Confirma a exclusão do médico <?php echo $row['nome']; ?>?</p>
            <input type="submit" name="confirmar" value="Sim">
            <input type="reset" value="Não">
        </form>
        <?php
    } else {
        echo "<p>Médico não encontrado.</p>";
    }


    mysqli_close($con);
} else {
    echo "<p>ID do médico não especificado.</p>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirmar'])) {
    include('conexao.php');
    $id_medico = $_POST["id_medico"];
    $query = "DELETE FROM medico WHERE id_medico = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "i", $id_medico);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo "<p>Médico excluído com sucesso!</p>";
    } else {
        echo "<p>ERRO ao excluir o médico: " . mysqli_error($con) . "</p>";
    }

    mysqli_close($con);
}
?>
</body>
</html>
