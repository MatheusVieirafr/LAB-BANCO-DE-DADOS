<?php
    session_start();
    include_once("conexao.php");
    $matricula = filter_input(INPUT_GET, 'matricula', FILTER_SANITIZE_NUMBER_INT);
    $result = "SELECT * FROM enfermeiro where matricula = '$matricula'";
    $resultado = mysqli_query($con, $result);
    $row = mysqli_fetch_assoc($resultado);
    $id_funcao = $row['id_funcao'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>CRUD - Editar Enfermeiro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }
        h1 {
            text-align: center;
            color: #00008B; /* Azul escuro */
        }
        form {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: inline-block;
            width: 150px;
            margin-right: 10px;
        }
        input[type="text"],
        input[type="number"],
        input[type="email"],
        select {
            width: calc(100% - 170px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #00008B; /* Azul escuro */
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0000CD; /* Azul médio */
        }
        fieldset {
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
        }
        legend {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Alteração - Enfermeiro</h1>
    <?php
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>
    <form method="POST" action="proc_edit_enf.php">
        <input type="hidden" name="matricula" value="<?php echo $row['matricula']; ?>">
 
        <p><label>Nome: </label><input type="text" name="nome" size="100" value="<?php echo $row['nome']; ?>">
            <label>CPF: </label><input type="text" name="cpf" size="30" value="<?php echo $row['cpf']; ?>">
            <label>RG: </label><input type="text" name="rg" size="30" value="<?php echo $row['rg']; ?>">
        </p>

        <fieldset><legend>Endereço</legend>
            <table width="80%">
                <tr>
                    <td>Endereço: </td><td><input type="text" name="endereco" size="100"
                        value="<?php echo $row['endereco'];?>"></td>

                    <td>Número: </td><td><input type="number" name="numero"
                        value="<?php echo $row["numero"];?>"></td>
                </tr>

                <tr>
                    <td>Cidade: </td><td><input type="text" name="cidade"
                        value="<?php echo $row['cidade'];?>"></td>

                    <td>Bairro: </td><td><input type="text" name="bairro"
                        value="<?php echo $row['bairro'];?>"></td>

                    <td>Estado: </td><td><select name="estado">
                        <option value="<?php echo $row['estado'];?>"></option>
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
                    </td>
                </tr>
            </table>
        <p>
            <label>Telefone: </label><input type="text" name="telefone" value="<?php echo $row['telefone']; ?>">
            <label>Celular: </label><input type="text" name="celular" value="<?php echo $row['celular']; ?>">
            <label>Email: </label><input type="email" name="email" value="<?php echo $row['email']; ?>">
        </p>
        <p>
            <label>Salário: </label><input type="text" name="salario" value="<?php echo $row['salario']; ?>">
            <label>Turno de Trabalho: </label>
            <select name="turno_trabalho">
                <option value="Manhã">Manhã</option>
                <option value="Tarde">Tarde</option>
                <option value="Noite">Noite</option>
            </select>
        </p>
        </fieldset>

        <p><label>Função: </label>
            <select name='id_funcao'>
                <?php
                    $query = "SELECT * FROM funcao WHERE id = $id_funcao";
                    $resu = mysqli_query($con, $query) or die(mysqli_connect_error());
                    $reg = mysqli_fetch_assoc($resu);
                    echo "<option value='".$row['id_funcao']."'>".$reg['descricao']."</option>";

                    $query2 = "SELECT * FROM funcao ORDER BY descricao";
                    $resu2 = mysqli_query($con, $query2) or die(mysqli_connect_error());
                    while ($reg2 = mysqli_fetch_array($resu2)) {
                        echo "<option value='".$reg2['id']."'>".$reg2['descricao']."</option>";
                    }
                    mysqli_close($con);
                ?>
            </select>
        </p>
        <p><input type="submit" value="Salvar"></p>
    </form>
</body>
</html>
