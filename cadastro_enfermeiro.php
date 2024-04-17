<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cadastro Enfermeiro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0; /* Cor de fundo cinza claro */
            margin: 0;
            padding: 0;
        }

        h1 {
            color: #00008B; /* Azul escuro */
            text-align: center;
            margin-top: 20px;
        }

        form {
            width: 50%;
            margin: 20px auto;
            background-color: #fff; /* Fundo branco */
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #00008B; /* Azul escuro */
        }

        input[type="text"],
        input[type="number"],
        input[type="tel"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"],
        input[type="reset"] {
            padding: 10px 20px;
            background-color: #00008B; /* Azul escuro */
            color: #fff; /* Texto branco */
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: #4169E1; /* Azul royal */
        }

        p {
            margin-bottom: 10px;
        }

        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff; /* Fundo branco */
            color: #00008B; /* Azul escuro */
        }
    </style>
</head>
<body>
    <h1>Enfermeiro inclusão</h1>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            Include('conexao.php');
            $nome = $_POST['nome'];
            $endereco = $_POST['endereco'];
            $numero = $_POST['numero'];
            $bairro = $_POST['bairro'];
            $cidade = $_POST['cidade'];
            $estado = $_POST['estado'];
            $cpf = $_POST['cpf'];
            $rg = $_POST['rg'];
            $telefone = $_POST['telefone'];
            $celular = $_POST['celular'];
            $email = $_POST['email'];
            $salario = $_POST['salario'];
            $turno_trabalho = $_POST['turno_trabalho'];
            $id_funcao = $_POST['id_funcao'];

            $query = "INSERT INTO enfermeiro (nome, endereco, numero, bairro, cidade, estado, cpf, rg, telefone, celular, email, salario, turno_trabalho, id_funcao)
            VALUES ('$nome','$endereco','$numero','$bairro','$cidade','$estado','$cpf', '$rg', '$telefone', '$celular', '$email', '$salario', '$turno_trabalho', '$id_funcao')";
            $resu = mysqli_query($con, $query);

            if (mysqli_insert_id($con)) {
                echo "Inclusão realizada com sucesso!";
            } else {
                echo "ERRO ao inserir os dados: " . mysqli_connect_error();
            }
            mysqli_close($con);
        }
    ?>

    <form method="POST">
        <br>
        <label>Nome:</label>
        <input type="text" size="80" maxlength="100" name="nome" required>
        <label>Endereço:</label>
        <input type="text" size="80" maxlength="100" name="endereco" required>
        <label>Número:</label>
        <input type="number" maxlength="100" name="numero" required><br><br>
        <label>Bairro:</label>
        <input type="text" size="60" maxlength="60" name="bairro" required>
        <label>Cidade:</label>
        <input type="text" size="40" maxlength="80" name="cidade" required>
        <label>Estado:</label>
        <select name="estado">
            <option value="AC">Acre</option>
            <option value="AL">Alagoas</option>
            <option value="AP">Amapá</option>
            <option value="AM">Amazonas</option>
            <option value="BA">Bahia</option>
            <option value="CE">Ceará</option>
            <option value="DF">Distrito Federal</option>
            <option value="ES">Espírito Santo</option>
            <option value="GO">Goiás</option>
            <option value="MA">Maranhão</option>
            <option value="MG">Minas Gerais</option>
            <option value="MT">Mato Grosso</option>
            <option value="MS">Mato Grosso do Sul</option>
            <option value="PA">Pará</option>
            <option value="PB">Paraíba</option>
            <option value="PE">Pernambuco</option>
            <option value="PI">Piauí</option>
            <option value="PR">Paraná</option>
            <option value="RJ">Rio de Janeiro</option>
            <option value="RN">Rio Grande do Norte</option>
            <option value="RS">Rio Grande do Sul</option>
            <option value="RO">Rondônia</option>
            <option value="RR">Roraima</option>
            <option value="SC">Santa Catarina</option>
            <option value="SE">Sergipe</option>        
            <option value="SP">São Paulo</option>
            <option value="TO">Tocantins</option>
        </select>
        <p>
            <label>CPF:</label>
            <input type="text" size="11" maxlength="11" name="cpf" required>
            <label>RG:</label>
            <input type="text" size="9" maxlength="9" name="rg" required>
            <label>Telefone:</label>
            <input type="tel" name="telefone" maxlength="15" placeholder="(XX) XXXXX-XXXX">
            <label>Celular:</label>
            <input type="tel" name="celular" maxlength="15" placeholder="(XX) XXXXX-XXXX">
            <label>Email:</label>
            <input type="text" size="12" maxlength="100" name="email" placeholder="nome@email.com">
            <label>Salário:</label>
            <input type="number" min="0" max="30000" step="100" name="salario" required>
            <label>Turno:</label>
            <select name="turno_trabalho">
                <option value="Manhã">Manhã</option>
                <option value="Tarde">Tarde</option>
                <option value="Noite">Noite</option>
            </select>
            <label>Função:</label>
            <select name= 'id_funcao'>
            <?php
                    include("conexao.php");
                    $query = 'SELECT * FROM funcao ORDER BY descricao;';
                    $resu = mysqli_query($con, $query) or die(mysqli_connect_error());
                    while ($reg = mysqli_fetch_array($resu)) {
                ?>
                <option value="<?php echo $reg['id']; ?>"><?php echo $reg['descricao']; ?></option>
                <?php
                    }
                    mysqli_close($con);
                ?>
            </select>
        </p>
        <input type="submit" value="Enviar"> <input type="reset" value="Limpar">
    </form>
</body>
</html>
