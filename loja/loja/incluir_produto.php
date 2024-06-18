<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Inclusão de Produto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 20px;
        }
        h1 {
            color: #333;
        }

        form {
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            padding: 50px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        label {
            display: inline-block;
            width: 150px;
            margin-bottom: 10px;
            font-weight: bold;
        }
        input[type="text"], input[type="number"]{
            width: calc(100% - 160px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 16px;
            box-sizing: border-box;
        }
        input[type="reset"], input[type="submit"] {
            width: calc(80% - 160px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 16px;
            box-sizing: border-box;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
            padding: 5px 10px;
            cursor: pointer;
            float: right;
        }
        input[type="reset"]:hover, input[type="submit"]:hover {
            background-color: #45a049;
        }
        p {
            margin-bottom: 0;
        }
        .success {
            color: green;
            font-weight: bold;
        }
        .error {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Inclusão de Produto</h1>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include('conexao.php');
        $nome = $_POST["nome"];
        $qtde_estoque = $_POST["qtde_estoque"];
        $preco = $_POST["preco"];
        $unidade_medida = $_POST["unidade_medida"];
        $promocao = $_POST["promocao"];
        
        $query = "INSERT INTO produto (nome, qtde_estoque, preco, unidade_medida, promocao) VALUES ('$nome', $qtde_estoque, $preco, '$unidade_medida', '$promocao')";
        
        $resu = mysqli_query($con, $query);
        
        if ($resu) {
            echo '<p class="success">Inclusão realizada com sucesso!</p>';
        } else {
            echo '<p class="error">ERRO ao inserir os dados: ' . mysqli_error($con) . '</p>';
        }
        
        mysqli_close($con);
    }
    ?>
    <form method="POST">
        <p><label>Nome:</label>
        <input type="text" name="nome" required></p>
        
        <p><label>Quantidade em Estoque:</label>
        <input type="number" name="qtde_estoque" required></p>
        
        <p><label>Preço:</label>
        <input type="number" name="preco" step="0.01" required></p>
        
        <p><label>Unidade de Medida:</label>
        <input type="text" name="unidade_medida" required></p>
        
        <p><label>Promoção (S/N):</label>
        <input type="text" name="promocao" maxlength="1" required></p>
        
        <p>
            <input type="submit" value="Enviar">
            <input type="reset" value="Limpar">
        </p>
    </form>
</body>
</html>
