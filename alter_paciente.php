<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Paciente</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0ebeb;
            margin: 0;
            padding: 0;
        }

        h1 {
            color: #ff69b4; /* Rosa */
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
            color: #ff69b4; /* Rosa */
        }

        input[type="text"] {
            width: calc(100% - 10px);
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #ff69b4; /* Rosa */
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #d94d86; /* Rosa mais escuro */
        }
    </style>
</head>
<body>
<h1>Editar Paciente</h1>
<?php
include('conexao.php');

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM paciente WHERE id = $id";
    $resultado = mysqli_query($con, $query) or die(mysqli_connect_error());

    if(mysqli_num_rows($resultado) == 1) {
        $registro = mysqli_fetch_assoc($resultado);
        ?>
        <form method="POST" action="atualizar_paciente.php">
            <input type="hidden" name="id" value="<?php echo $registro['id']; ?>">
            <label>Nome:</label>
            <input type="text" name="nome" value="<?php echo $registro['nome']; ?>"><br>
            <label>Endereço:</label>
            <input type="text" name="endereco" value="<?php echo $registro['endereco']; ?>"><br>
            <label>Número:</label>
            <input type="text" name="numero" value="<?php echo $registro['numero']; ?>"><br>
            <label>Complemento:</label>
            <input type="text" name="complemento" value="<?php echo $registro['complemento']; ?>"><br>
            <label>Bairro:</label>
            <input type="text" name="bairro" value="<?php echo $registro['bairro']; ?>"><br>
            <label>Cidade:</label>
            <input type="text" name="cidade" value="<?php echo $registro['cidade']; ?>"><br>
            <label>Estado:</label>
            <input type="text" name="estado" value="<?php echo $registro['estado']; ?>"><br>
            <label>CPF:</label>
            <input type="text" name="cpf" value="<?php echo $registro['cpf']; ?>"><br>
            <label>RG:</label>
            <input type="text" name="rg" value="<?php echo $registro['rg']; ?>"><br>
            <label>Telefone:</label>
            <input type="text" name="telefone" value="<?php echo $registro['telefone']; ?>"><br>
            <label>Celular:</label>
            <input type="text" name="celular" value="<?php echo $registro['celular']; ?>"><br>
            <label>Email:</label>
            <input type="text" name="email" value="<?php echo $registro['email']; ?>"><br>
            <input type="submit" value="Salvar">
        </form>
        <?php
    } else {
        echo "Paciente não encontrado.";
    }
} else {
    echo "ID do paciente não especificado.";
}
mysqli_close($con);
?>
</body>
</html>
