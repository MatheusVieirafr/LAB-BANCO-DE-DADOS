<?php
session_start();
include_once("conexao.php");
$id_medico = filter_input(INPUT_GET, 'id_medico', FILTER_SANITIZE_NUMBER_INT);
$result = "SELECT * FROM medico WHERE id_medico = '$id_medico'";
$resultado = mysqli_query($con, $result);
$row = mysqli_fetch_assoc($resultado);
$cod_esp = $row['cod_esp'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>CRUD - Editar Médico</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        h1 {
            color: green;
            text-align: center;
            margin-top: 20px;
        }

        form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: green;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: calc(100% - 10px);
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            background-color: green;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: darkgreen;
        }

        fieldset {
            margin-bottom: 15px;
        }

        legend {
            color: green;
            font-weight: bold;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
        }

        table td {
            padding: 8px;
        }
    </style>
</head>
<body>
<h1>Alteração - Médico</h1>
<?php
if (isset($_SESSION['msg'])) {
    echo "<p style='color: green; text-align: center;'>" . $_SESSION['msg'] . "</p>";
    unset($_SESSION['msg']);
}
?>

<form method="POST" action="proc_edit_medico.php">
    <input type="hidden" name="id_medico" value="<?php echo $row['id_medico']; ?>">
    <p>
        <label>Nome:</label>
        <input type="text" name="nome" size="100" value="<?php echo $row['nome']; ?>">
        <label>CPF:</label>
        <input type="text" name="cpf" size="30" value="<?php echo $row['cpf']; ?>">
    </p>
    <fieldset>
        <legend>Endereço</legend>
        <table>
            <tr>
                <td>Endereço:</td>
                <td><input type="text" name="endereco" size="100" value="<?php echo $row['endereco']; ?>"></td>
                <td>Número:</td>
                <td><input type="number" name="numero" value="<?php echo $row['numero']; ?>"></td>
            </tr>
            <tr>
                <td>Cidade:</td>
                <td><input type="text" name="cidade" value="<?php echo $row['cidade']; ?>"></td>
                <td>Estado:</td>
                <td>
                    <select name="estado">
                        <option value="<?php echo $row['estado']; ?>"><?php echo $row['estado']; ?></option>
                        <option value="SP">SP</option>
                        <option value="BA">BA</option>
                        <option value="RJ">RJ</option>
                        <option value="MG">MG</option>
                        <option value="PR">PR</option>
                    </select>
                </td>
            </tr>
        </table>
    </fieldset>
    <p>
        <label>Especialidade:</label>
        <select name="cod_esp">
            <?php
            $query = "SELECT * FROM especialidade WHERE id= $cod_esp;";
            $resu = mysqli_query($con, $query) or die(mysqli_connect_error());
            $reg = mysqli_fetch_assoc($resu);
            ?>
            <option value="<?php echo $row['cod_esp'];?>">
                <?php echo $reg['descricao'];?></option>
            <?php
            $query2= "SELECT * from especialidade ORDER BY descricao;";
            $resu2= mysqli_query($con,$query2)or die (mysqli_connect_error());
            while ($reg2 = mysqli_fetch_array($resu2)) {
                ?>
                <option value="<?php echo $reg2['id'];?>"><?php echo $reg2['descricao'];?></option>
                <?php
            }
            mysqli_close($con);
            ?>
        </select>
    </p>
    <input type="submit" value="Salvar">
</form>
</body>
</html>
