<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Alteração de Cliente</title>
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
            width: 150px;
            font-weight: bold;
        }

        form input[type="text"],
        form input[type="email"],
        form input[type="number"],
        form input[type="date"] {
            width: calc(100% - 160px);
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
    <h1>Alteração de Cliente</h1>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['atualizar'])) {
        include('conexao.php');
        $id = $_POST["id"];
        $nome = $_POST["nome"];
        $endereco = $_POST["endereco"];
        $numero = $_POST["numero"];
        $bairro = $_POST["bairro"];
        $cidade = $_POST["cidade"];
        $estado = $_POST["estado"];
        $email = $_POST["email"];
        $cpf_cnpj = $_POST["cpf_cnpj"];
        $rg = $_POST["rg"];
        $telefone = $_POST["telefone"];
        $celular = $_POST["celular"];
        $data_nasc = $_POST["data_nasc"];
        $salario = $_POST["salario"];
        
        $query = "UPDATE clientes SET nome='$nome', endereco='$endereco', numero='$numero', 
        bairro='$bairro', cidade='$cidade', estado='$estado', email='$email', cpf_cnpj='$cpf_cnpj', 
        rg='$rg', telefone='$telefone', celular='$celular', data_nasc='$data_nasc', salario='$salario' 
        WHERE id=$id";

        $resu = mysqli_query($con, $query);
        if ($resu) {
            echo "Atualização realizada com sucesso!";
        } else {
            echo "ERRO ao atualizar os dados: " . mysqli_error($con);
        }
        mysqli_close($con);
        header("Location: consulta_clientes.php");
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cancelar'])) {
        header("Location: consulta_clientes.php");
    }
    ?>
    <?php
    if (isset($_GET['id'])) {
        include('conexao.php');
        $id = $_GET['id'];
        $query = "SELECT * FROM clientes WHERE id = $id";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);
    ?>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <p><label>Nome:</label>
        <input type="text" name="nome" required value="<?php echo $row['nome']; ?>"></p>
        <p><label>Endereço:</label>
        <input type="text" name="endereco" required value="<?php echo $row['endereco']; ?>"></p>
        <p><label>Número:</label>
        <input type="text" name="numero" value="<?php echo $row['numero']; ?>"></p>
        <p><label>Bairro:</label>
        <input type="text" name="bairro" required value="<?php echo $row['bairro']; ?>"></p>
        <p><label>Cidade:</label>
        <input type="text" name="cidade" required value="<?php echo $row['cidade']; ?>"></p>
        <p><label>Estado:</label>
        <input type="text" name="estado" maxlength="2" required value="<?php echo $row['estado']; ?>"></p>
        <p><label>Email:</label>
        <input type="email" name="email" required value="<?php echo $row['email']; ?>"></p>
        <p><label>CPF/CNPJ:</label>
        <input type="text" name="cpf_cnpj" required value="<?php echo $row['cpf_cnpj']; ?>"></p>
        <p><label>RG:</label>
        <input type="text" name="rg" required value="<?php echo $row['rg']; ?>"></p>
        <p><label>Telefone:</label>
        <input type="text" name="telefone" value="<?php echo $row['telefone']; ?>"></p>
        <p><label>Celular:</label>
        <input type="text" name="celular" required value="<?php echo $row['celular']; ?>"></p>
        <p><label>Data de Nascimento:</label>
        <input type="date" name="data_nasc" required value="<?php echo $row['data_nasc']; ?>"></p>
        <p><label>Salário:</label>
        <input type="number" name="salario" step="0.01" required value="<?php echo $row['salario']; ?>"></p>
        <p><input type="submit" name="atualizar" value="Atualizar">
        <input type="submit" name="cancelar" value="Cancelar"></p>
    </form>
    <?php
    }
    ?>
</body>
</html>
