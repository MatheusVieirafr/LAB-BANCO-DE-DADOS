<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Exclusão de Paciente</title>
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
            width: 50%;
            margin: 20px auto;
            background-color: #fff; /* Branco */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #ff69b4; /* Rosa */
        }

        input[type="text"] {
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
            margin-right: 10px;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: #d94d86; /* Rosa mais escuro */
        }
    </style>
    <script>
        function redirecionarParaListaPacientes() {
            window.location.href = "lista_pacientes.php";
        }
    </script>
</head>
<body>
    <h1>Exclusão de Paciente</h1>
    <?php
    if (isset($_GET['id'])) {
       
        include('conexao.php');
        
        $id = $_GET['id'];
       
        $query = "SELECT * FROM paciente WHERE id = ?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        $row = mysqli_fetch_assoc($result);

        
        if ($row) {
    ?>
            <form method="POST">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <label>Nome:</label>
                <input type="text" value="<?php echo $row['nome']; ?>" readonly>
                <label>CPF:</label>
                <input type="text" value="<?php echo $row['cpf']; ?>" readonly>
                <p>Confirma a exclusão do paciente <?php echo $row['nome']; ?>?</p>
                <input type="submit" name="confirmar" value="Sim" onclick="redirecionarParaListaPacientes()">
                <input type="reset" value="Não">
            </form>
    <?php
        } else {
            echo "<p>Paciente não encontrado.</p>";
        }
        
        
        mysqli_close($con);
    } else {
        echo "<p>ID do paciente não especificado.</p>";
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirmar'])) {
        include('conexao.php');
        $id = $_POST["id"];
        $query = "DELETE FROM paciente WHERE id = ?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            echo "<p>Paciente excluído com sucesso!</p>";
        } else {
            echo "<p>ERRO ao excluir o paciente: " . mysqli_error($con) . "</p>";
        }
        
        mysqli_close($con);
    }
    ?>
</body>
</html>
