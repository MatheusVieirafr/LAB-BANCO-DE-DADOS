<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Especialidades Médicas</title>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }
        h1 {
            color: purple;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            max-width: 600px;
            margin: 0 auto;
        }
        label {
            font-weight: bold;
            color: purple;
        }
        input[type="text"], input[type="submit"], input[type="reset"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }
        input[type="submit"], input[type="reset"] {
            background-color: purple;
            color: #fff;
            cursor: pointer;
        }
        input[type="submit"]:hover, input[type="reset"]:hover {
            background-color: #6a0080;
        }
    </style>
</head>
<body>
    <h1>Cadastro de Especialidades Médicas - Inclusão</h1>
    <?php
    //Verifica se o formulário foi submetido
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include('conexao.php');

        //Prepara os dados para inserção
        $nome = $_POST["nome"];
        $sigla = $_POST["sigla"];

        //Prepara a consulta SQL para inserção de dados
        $query = "INSERT INTO especialidade (descricao, sigla)
                VALUES ('$nome', '$sigla')";

        //Executa a consulta SQL
        $resu = mysqli_query($con, $query);

        //Verifica se conseguiu inserir o registro
        if (mysqli_insert_id($con)) {
            echo "Inclusão realizada com sucesso !!";
        } else {
            echo "ERRO ao inserir os dados: " . mysqli_connect_error() ;
        }
        //Fecha a conexão com o banco de dados
        mysqli_close($con);
    }
    ?>
    <form method="POST">
        <label for="nome">Descrição da especialidade:</label>
        <input type="text" name="nome" size="100" maxlength="100" required>
        <p><label>Sigla:</label>
        <input type="text" name="sigla" size="3" maxlength="3" required>
        <p><input type="submit" value="Enviar">
            <input type="reset" value="Limpar">
    </form>        
</body>
</html>
