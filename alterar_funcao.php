<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Alteração de Funções Médicas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f57c00; /* Laranja */
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        h1 {
            color: #fff; /* Texto branco */
            margin-top: 30px;
        }
        form {
            background-color: #fff; /* Fundo branco */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Sombra suave */
            width: 50%;
            max-width: 500px;
        }
        label {
            color: #f57c00; /* Laranja */
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"] {
            width: calc(100% - 22px); /* Ajuste para compensar o padding */
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #f57c00; /* Laranja */
            border-radius: 5px;
        }
        input[type="submit"], input[type="reset"] {
            background-color: #f57c00; /* Laranja */
            color: #fff; /* Texto branco */
            border: none;
            border-radius: 5px;
            cursor: pointer;
            padding: 10px 20px;
            margin-right: 10px;
        }
        input[type="submit"]:hover, input[type="reset"]:hover {
            background-color: #ff9800; /* Laranja mais claro */
        }
    </style>
</head>
<body>
    <h1>Alteração de Funções Médicas</h1>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['atualizar'])) {
        include('conexao.php');

        $id = $_POST["id"];
        $descricao = $_POST["descricao"];

        $query = "UPDATE funcao SET descricao='$descricao' WHERE id=$id";

        $resu = mysqli_query($con, $query);

        if ($resu) {
            echo "<p style='color: #d81b60; text-align: center;'>Atualização realizada com sucesso!</p>";
        } else {
            echo "<p style='color: red; text-align: center;'>ERRO ao atualizar os dados: " . mysqli_error($con) . "</p>";
        }

        mysqli_close($con);
        header("Location: consulta_funcao.php");
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cancelar'])) {
        header("Location: consulta_funcao.php");
    }

    ?>
    <?php
    if (isset($_GET['id'])) {
        include('conexao.php');
        $id = $_GET['id'];

        $query = "SELECT * FROM funcao WHERE id = $id";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);
    ?>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label for="descricao">Descrição da Função:</label>
        <input type="text" id="descricao" name="descricao" size="100" maxlength="100" required value="<?php echo $row['descricao']; ?>">
        <p>
            <input type="submit" name="atualizar" value="Atualizar">
            <input type="submit" name="cancelar" value="Cancelar">
        </p>
    </form>
    <?php
    }
    ?>
</body>
</html>
