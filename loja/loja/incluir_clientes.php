<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Cliente</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 20px;
            padding: 20px;
        }
        
        h1 {
            text-align: center;
            color: #333;
        }
        
        form {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        
        label {
            font-weight: bold;
        }
        
        input[type=text], input[type=email], input[type=number], input[type=date] {
            width: calc(100% - 12px);
            padding: 8px;
            margin: 6px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        
        input[type=submit], input[type=reset] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }
        
        input[type=submit]:hover, input[type=reset]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Inclusão de Cliente</h1>
    
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       
        include('conexao.php');
        
        
        function validar_dados($dados) {
            $dados = trim($dados);
            $dados = stripslashes($dados);
            $dados = htmlspecialchars($dados);
            return $dados;
        }
        
        
        $nome = validar_dados($_POST['nome']);
        $endereco = validar_dados($_POST['endereco']);
        $numero = validar_dados($_POST['numero']);
        $bairro = validar_dados($_POST['bairro']);
        $cidade = validar_dados($_POST['cidade']);
        $estado = validar_dados($_POST['estado']);
        $email = validar_dados($_POST['email']);
        $cpf_cnpj = validar_dados($_POST['cpf_cnpj']);
        $rg = validar_dados($_POST['rg']);
        $telefone = validar_dados($_POST['telefone']);
        $celular = validar_dados($_POST['celular']);
        $data_nasc = validar_dados($_POST['data_nasc']);
        $salario = validar_dados($_POST['salario']);
        
    
        $query = "INSERT INTO clientes (nome, endereco, numero, bairro, cidade, estado, 
        email, cpf_cnpj, rg, telefone, celular, data_nasc, salario) 
        VALUES ('$nome', '$endereco', '$numero', '$bairro', '$cidade', '$estado', '$email', 
        '$cpf_cnpj', '$rg', '$telefone', '$celular', '$data_nasc', $salario)";
        
     
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
        <label>Nome:</label><br>
        <input type="text" name="nome" required><br><br>
        
        <label>Endereço:</label><br>
        <input type="text" name="endereco" required><br><br>
        
        <label>Número:</label><br>
        <input type="text" name="numero"><br><br>
        
        <label>Bairro:</label><br>
        <input type="text" name="bairro" required><br><br>
        
        <label>Cidade:</label><br>
        <input type="text" name="cidade" required><br><br>
        
        <label>Estado:</label><br>
        <input type="text" name="estado" maxlength="2" required><br><br>
        
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>
        
        <label>CPF/CNPJ:</label><br>
        <input type="text" name="cpf_cnpj" required><br><br>
        
        <label>RG:</label><br>
        <input type="text" name="rg" required><br><br>
        
        <label>Telefone:</label><br>
        <input type="text" name="telefone"><br><br>
        
        <label>Celular:</label><br>
        <input type="text" name="celular" required><br><br>
        
        <label>Data de Nascimento:</label><br>
        <input type="date" name="data_nasc" required><br><br>
        
        <label>Salário:</label><br>
        <input type="number" name="salario" step="0.01" required><br><br>
        
        <input type="submit" value="Enviar">
        <input type="reset" value="Limpar">
    </form>
</body>
</html>
