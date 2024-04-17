<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Médicos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            color: green; /* Define a cor do texto como verde */
        }

        h1 {
            color: green; /* Título em verde */
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: green; /* Labels em verde */
        }

        input[type="text"],
        input[type="number"],
        select,
        input[type="tel"],
        input[type="submit"],
        input[type="reset"] {
            width: calc(100% - 10px);
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            color: green; /* Inputs e botões em verde */
        }

        input[type="submit"],
        input[type="reset"] {
            background-color: green; /* Fundo dos botões em verde */
            color: white; /* Cor do texto dos botões em branco */
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: darkgreen; /* Fundo dos botões escuro ao passar o mouse */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Cadastro de Médicos - Inclusão</h1>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            Include('conexao.php');

            $nome = $_POST['nome'];
            $cpf = $_POST['cpf'];
            $endereco = $_POST['endereco'];
            $numero = $_POST['numero'];
            $bairro = $_POST['bairro'];
            $cidade = $_POST['cidade'];
            $estado = $_POST['estado'];
            $crm = $_POST['crm'];
            $salario = $_POST['salario'];
            $celular = $_POST['celular'];
            $cod_esp = $_POST['cod_esp'];

            $query = "INSERT INTO medico (nome, cpf, endereco, numero, bairro, cidade, estado, crm, salario, celular, cod_esp)
            VALUES ('$nome','$cpf','$endereco','$numero','$bairro','$cidade','$estado','$crm','$salario','$celular','$cod_esp')";
            $resu = mysqli_query($con, $query);

            if (mysqli_insert_id($con)) {
                echo "<p style='color: green; text-align: center;'>Inclusão realizada com sucesso!!</p>";
            } else {
                echo "<p style='color: red; text-align: center;'>ERRO ao inserir os dados: " . mysqli_connect_error() . "</p>";
            }
            mysqli_close($con);
        }
        ?>

        <form method="POST">
            <label>Nome:</label>
            <input type="text" maxlength="100" name="nome" required><br>
            <label>CPF:</label>
            <input type="text" maxlength="11" name="cpf" required><br>
            <label>Endereço:</label>
            <input type="text" maxlength="100" name="endereco" required><br>
            <label>Número:</label>
            <input type="number" maxlength="100" name="numero" required><br>
            <label>Bairro:</label>
            <input type="text" maxlength="60" name="bairro" required><br>
            <label>Cidade:</label>
            <input type="text" maxlength="80" name="cidade" required><br>
            <label>Estado:</label>
            <select name="estado">
                <option value="SP">São Paulo</option>
                <option value="MG">Minas Gerais</option>
                <option value="PR">Paraná</option>
                <option value="RJ">Rio de Janeiro</option>
            </select><br>
            <label>CRM:</label>
            <input type="text" maxlength="20" name="crm" required><br>
            <label>Salário:</label>
            <input type="number" min="0" max="30000000000" step="100" name="salario" required><br>
            <label>Celular:</label>
            <input type="tel" maxlength="15" placeholder="(XX) XXXXX-XXXX" name="celular"><br>
            <label>Especialidade:</label>
            <select name="cod_esp">
                <?php
                include("conexao.php");
                $query = 'SELECT * FROM especialidade ORDER BY descricao;';
                $resu = mysqli_query($con, $query) or die(mysqli_connect_error());
                while ($reg = mysqli_fetch_array($resu)) {
                ?>
                    <option value="<?php echo $reg['id']; ?>"><?php echo $reg['descricao']; ?></option>
                <?php
                }
                mysqli_close($con);
                ?>
            </select><br>
            <input type="submit" value="Enviar">
            <input type="reset" value="Limpar">
        </form>
    </div>
</body>
</html>
