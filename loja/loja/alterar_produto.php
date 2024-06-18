<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Alteração de Produto</title>
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
        form input[type="number"] {
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
    <h1>Alteração de Produto</h1>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['atualizar'])) {
        include('conexao.php');
        $id = $_POST["id"];
        $nome = $_POST["nome"];
        $qtde_estoque = $_POST["qtde_estoque"];
        $preco = $_POST["preco"];
        $unidade_medida = $_POST["unidade_medida"];
        $promocao = $_POST["promocao"];
        $query = "UPDATE produto SET nome='$nome', qtde_estoque=$qtde_estoque, preco=$preco, unidade_medida='$unidade_medida', promocao='$promocao' WHERE id=$id";
        $resu = mysqli_query($con, $query);
        if ($resu) {
            echo "Atualização realizada com sucesso!";
        } else {
            echo "ERRO ao atualizar os dados: " . mysqli_error($con);
        }
        mysqli_close($con);
        header("Location: consulta_produto.php");
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cancelar'])) {
        header("Location: consulta_produto.php");
    }
    ?>
    <?php
    if (isset($_GET['id'])) {
        include('conexao.php');
        $id = $_GET['id'];
        $query = "SELECT * FROM produto WHERE id = $id";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);
    ?>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <p><label>Nome:</label>
        <input type="text" name="nome" required value="<?php echo $row['nome']; ?>"></p>
        <p><label>Quantidade em Estoque:</label>
        <input type="number" name="qtde_estoque" required value="<?php echo $row['qtde_estoque']; ?>"></p>
        <p><label>Preço:</label>
        <input type="number" name="preco" step="0.01" required value="<?php echo $row['preco']; ?>"></p>
        <p><label>Unidade de Medida:</label>
        <input type="text" name="unidade_medida" required value="<?php echo $row['unidade_medida']; ?>"></p>
        <p><label>Promoção (S/N):</label>
        <input type="text" name="promocao" maxlength="1" required value="<?php echo $row['promocao']; ?>"></p>
        <p><input type="submit" name="atualizar" value="Atualizar">
        <input type="submit" name="cancelar" value="Cancelar"></p>
    </form>
    <?php
    }
    ?>
</body>
</html>
