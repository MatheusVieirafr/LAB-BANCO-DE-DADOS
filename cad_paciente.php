<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Pacientes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0ebeb; /* Rosa claro */
            margin: 0;
            padding: 0;
        }

        h1 {
            color: #ff69b4; /* Rosa */
            text-align: center;
            margin-top: 20px;
        }

        form {
            width: 60%;
            margin: 20px auto;
            background-color: #fff; /* Branco */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #ff69b4; /* Rosa */
        }

        input[type="text"],
        input[type="number"],
        input[type="tel"],
        input[type="email"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"],
        input[type="reset"] {
            padding: 10px 20px;
            background-color: #ff69b4; /* Rosa */
            color: #fff; /* Branco */
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: #d94d86; /* Rosa mais escuro */
        }
    </style>
</head>
<body>
    <h1>Cadastro de Pacientes - Inclusão</h1>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include('conexao.php');
        $nome = $_POST['nome'];
        $endereco = $_POST['endereco'];
        $numero = $_POST['numero'];
        $complemento = $_POST['complemento'];
        $bairro = $_POST['bairro'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];
        $cpf = $_POST['cpf'];
        $rg = $_POST['rg'];
        $telefone = $_POST['telefone'];
        $celular = $_POST['celular'];
        $email = $_POST['email'];

        $query = "INSERT INTO paciente (nome, endereco, numero, complemento, bairro, cidade, estado, cpf, rg, telefone, celular, email)
        VALUES ('$nome','$endereco','$numero','$complemento','$bairro','$cidade','$estado','$cpf','$rg','$telefone','$celular','$email')";
        $resu = mysqli_query($con, $query);

        if (mysqli_insert_id($con)) {
            echo "<p style='color: green;'>Inclusão realizada com sucesso!</p>";
        } else {
            echo "<p style='color: red;'>ERRO ao inserir os dados: " . mysqli_connect_error() . "</p>";
        }
        mysqli_close($con);
    }
    ?>

    <form method="POST">
        <label>Nome:</label>
        <input type="text" size="80" maxlength="100" name="nome" required><br>
        <label>Endereço:</label>
        <input type="text" size="80" maxlength="100" name="endereco" required><br>
        <label>Número:</label>
        <input type="number" name="numero" required><br>
        <label>Complemento:</label>
        <input type="text" name="complemento" required><br>
        <label>Bairro:</label>
        <input type="text" size="60" maxlength="60" name="bairro" required><br>
        <label>Cidade:</label>
        <input type="text" size="40" maxlength="80" name="cidade" required><br>
        <label>Estado:</label>
        <select name="estado">
            <option value="SP">São Paulo</option>
            <option value="MG">Minas Gerais</option>
            <option value="PR">Paraná</option>
            <option value="RJ">Rio de Janeiro</option>
        </select><br>
        <label>CPF:</label>
        <input type="text" size="20" maxlength="20" name="cpf" required><br>
        <label>RG:</label>
        <input type="text" size="20" maxlength="20" name="rg" required><br>
        <label>Telefone:</label>
        <input type="tel" name="telefone" required><br>
        <label>Celular:</label>
        <input type="tel" name="celular" maxlength="15" placeholder="(XX) XXXXX-XXXX"><br>
        <label>Email:</label>
        <input type="email" name="email" required><br>
        <input type="submit" value="Enviar">
        <input type="reset" value="Limpar">
    </form>
</body>
</html>
