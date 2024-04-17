<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Funções Médicas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fdd835; /* Laranja clarinho */
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            color: #fff; /* Texto branco */
            margin-top: 30px;
        }
        form {
            width: 50%;
            margin: 0 auto;
            background-color: #fff; /* Fundo branco */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Sombra suave */
        }
        label {
            color: #f57c00; /* Laranja */
        }
        input[type="text"], input[type="submit"], input[type="reset"] {
            width: calc(100% - 22px); /* Ajuste para compensar o padding */
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #f57c00; /* Laranja */
            border-radius: 5px;
            background-color: #fff; /* Fundo branco */
            color: #f57c00; /* Laranja */
        }
        input[type="submit"], input[type="reset"] {
            cursor: pointer;
            background-color: #f57c00; /* Laranja forte */
            color: #fff; /* Texto branco */
        }
        input[type="submit"]:hover, input[type="reset"]:hover {
            background-color: #ff9800; /* Laranja mais claro */
        }
    </style>
</head>
<body>
    <h1>Cadastro de Funções Médicas - Inclusão</h1>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include('conexao.php');
        $descricao = $_POST['descricao'];
     
        $query = "INSERT INTO funcao (descricao) VALUES ('$descricao')";
        $resu = mysqli_query($con, $query);

        if(mysqli_insert_id($con)){
            echo "<p style='color: #4caf50;'>Inclusão realizada com sucesso!</p>";
        } else {
            echo "<p style='color: #f44336;'>ERRO ao inserir os dados: " . mysqli_connect_error() . "</p>";
        }
        mysqli_close($con);
    }
    ?>
    <form method="POST">
        <label for="descricao">Descrição da Função:</label>
        <input type="text" id="descricao" name="descricao" size="100" maxlength="100" required>
        <br>
        <input type="submit" value="Enviar">
        <input type="reset" value="Limpar">
    </form>
</body>
</html>
