<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cadastro Forma de Pagamento</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
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
            display: inline-block;
            width: 150px;
            margin-bottom: 10px;
            font-weight: bold;
        }
        input[type="text"], input[type="submit"], input[type="reset"] {
            width: calc(100% - 160px); 
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 16px;
            box-sizing: border-box; 
        }
        input[type="submit"], input[type="reset"] {
            width: 80px; 
            margin-left: 10px;
            cursor: pointer;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
            padding: 10px;
        }
        input[type="submit"]:hover, input[type="reset"]:hover {
            background-color: #45a049; 
        }
    </style>
</head>
<body>
    <h1>Inclusão de Forma de Pagamento</h1>
    
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include('conexao.php'); 
        
        $nome = $_POST['nome'];
        
   
        $query = "INSERT INTO forma_pagto (nome) VALUES ('$nome')";
        
  
        $result = mysqli_query($con, $query);
      
        if ($result && mysqli_insert_id($con)) {
            echo "<p style='color: green;'>Inclusão realizada com sucesso!</p>";
        } else {
            echo "<p style='color: red;'>ERRO ao inserir os dados: " . mysqli_error($con) . "</p>";
        }
        
      
        mysqli_close($con);
    }
    ?>
    
    <form method="POST">
        <label for="nome">Função:</label>
        <input type="text" id="nome" name="nome" size="100" maxlength="100" required><br><br>
        
        <input type="submit" value="Enviar">
        <input type="reset" value="Limpar">
    </form>
</body>
</html>
