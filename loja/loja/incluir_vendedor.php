<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cadastro Vendedor</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
        }
        input[type="text"], input[type="email"], input[type="number"], input[type="reset"], input[type="submit"] {
            width: calc(100% - 20px);
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 16px;
            box-sizing: border-box;
        }
        input[type="reset"], input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
            padding: 10px 20px;
            cursor: pointer;
            float: right;
        }
        input[type="reset"]:hover, input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            font-weight: bold;
        }
        .success {
            color: green;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Inclusão de Vendedor</h1>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      
        include('conexao.php');
       
        $nome = $_POST['nome'];
        $endereco = $_POST['endereco'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];
        $celular = $_POST['celular'];
        $email = $_POST['email'];
        $perc_comissao = $_POST['perc_comissao'];
        
        $query = "INSERT INTO vendedor (nome, endereco, cidade, estado, celular, email, perc_comissao) VALUES ('$nome', '$endereco', '$cidade', '$estado', '$celular', '$email', '$perc_comissao')";
    
        $result = mysqli_query($con, $query);
        
        if ($result && mysqli_insert_id($con)) {
            echo '<p class="success">Inclusão realizada com sucesso!</p>';
        } else {
            echo '<p class="error">ERRO ao inserir os dados: ' . mysqli_error($con) . '</p>';
        }
   
        mysqli_close($con);
    }
    ?>
    <form method="POST">
        <label>Nome:</label>
        <input type="text" name="nome" size="50" maxlength="100" required>
        <br><br>
        <label>Endereço:</label>
        <input type="text" name="endereco" size="50" maxlength="100" required>
        <br><br>
        <label>Cidade:</label>
        <input type="text" name="cidade" size="30" maxlength="50" required>
        <br><br>
        <label>Estado:</label>
        <input type="text" name="estado" size="2" maxlength="2" required>
        <br><br>
        <label>Celular:</label>
        <input type="text" name="celular" size="20" maxlength="20" required>
        <br><br>
        <label>Email:</label>
        <input type="email" name="email" size="50" maxlength="100" required>
        <br><br>
        <label>Porcentagem de Comissão:</label>
        <input type="number" name="perc_comissao" min="0" step="0.01" required>
        <br><br>
        <input type="submit" value="Enviar">
        <input type="reset" value="Limpar">
    </form>
</body>
</html>
    