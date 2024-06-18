<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Alteração de Vendedor</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 20px;
            padding: 20px;
        }

        h1 {
            color: #333;
        }

        form {
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
        }

        form p {
            margin-bottom: 10px;
        }

        form label {
            display: inline-block;
            width: 200px;
            font-weight: bold;
        }

        form input[type="text"],
        form input[type="number"],
        form input[type="email"] {
            width: calc(100% - 210px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        form input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        form input[type="submit"]:hover {
            background-color: #45a049;
        }

        form input[type="submit"][name="cancelar"] {
            background-color: #f44336;
        }

        form input[type="submit"][name="cancelar"]:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <h1>Alteração de Vendedor</h1>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['atualizar'])) {
        include('conexao.php');
        $id = $_POST["id"];
        $nome = $_POST["nome"];
        $endereco = $_POST["endereco"];
        $cidade = $_POST["cidade"];
        $estado = $_POST["estado"];
        $celular = $_POST["celular"];
        $email = $_POST["email"];
        $perc_comissao = $_POST["perc_comissao"];

        $query = "UPDATE vendedor SET nome='$nome', endereco='$endereco', cidade='$cidade', estado='$estado', celular='$celular', email='$email', perc_comissao='$perc_comissao' WHERE id=$id";

        $result = mysqli_query($con, $query);

        if ($result) {
            echo "Atualização realizada com sucesso!";
        } else {
            echo "ERRO ao atualizar os dados: " . mysqli_error($con);
        }

        mysqli_close($con);

        header("Location: consulta_vendedor.php");

    } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cancelar'])) {
        header("Location: consulta_vendedor.php");
    }
    ?>
    <?php
    if (isset($_GET['id'])) {
        include('conexao.php');
        $id = $_GET['id'];
        $query = "SELECT * FROM vendedor WHERE id = $id";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);
    ?>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <p><label>Nome:</label>
        <input type="text" name="nome" size="100" maxlength="100" required value="<?php echo $row['nome']; ?>"></p>
        <p><label>Endereço:</label>
        <input type="text" name="endereco" size="100" maxlength="100" required value="<?php echo $row['endereco']; ?>"></p>
        <p><label>Cidade:</label>
        <input type="text" name="cidade" size="50" maxlength="50" required value="<?php echo $row['cidade']; ?>"></p>
        <p><label>Estado:</label>
        <input type="text" name="estado" size="2" maxlength="2" required value="<?php echo $row['estado']; ?>"></p>
        <p><label>Celular:</label>
        <input type="text" name="celular" size="20" maxlength="20" required value="<?php echo $row['celular']; ?>"></p>
        <p><label>Email:</label>
        <input type="email" name="email" size="100" maxlength="100" required value="<?php echo $row['email']; ?>"></p>
        <p><label>Porcentagem de Comissão:</label>
        <input type="number" name="perc_comissao" min="0" step="0.01" required value="<?php echo $row['perc_comissao']; ?>"></p>
        <p><input type="submit" name="atualizar" value="Atualizar">
            <input type="submit" name="cancelar" value="Cancelar"></p>
    </form>
    <?php
    }
    ?>
</body>
</html>
