<!DOCTYPE html>
<html lang="pt-br">
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
            text-align: center;
        }
        p {
            color: purple;
        }
        input[type="submit"] {
            background-color: purple;
            color: #fff;
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #6a0080;
        }
    </style>
</head>
<body>
    <h1>Exclusão de Especialidade</h1>
    <?php
    if (isset($_GET['id'])) {
        include('conexao.php');
        $id = $_GET['id'];

        $query = "SELECT * FROM especialidade WHERE id = $id";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);

        if ($row) {
    
                echo "<p>ID: " . $row['id'] . "</p>";
                echo "<p>Descrição: " . $row['descricao'] . "</p>";
                echo "<p>Sigla: " . $row['sigla'] . "</p>";
                echo "<p>Confirma a exclusão?</p>";
                echo "<form method='POST'>";
                echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                echo "<input type='submit' name='confirmar' value='Sim'>";
                echo "<input type='submit' name='cancelar' value='Não'>";
   
        } else {
            echo "Especialidade não encontrada.";
        }
        
        mysqli_close($con);
    } else {
        echo "ID da especialidade não especificado.";
    }
    ?>
    <?php
 
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirmar'])) {
        include('conexao.php');

        $id = $_POST["id"];

        $query = "DELETE FROM especialidade WHERE id = $id";

        $result = mysqli_query($con, $query);

        if ($result) {
            echo "Especialidade excluída com sucesso!";
        } else {
            echo "ERRO ao excluir a especialidade: " . mysqli_error($con);
        }
        
        mysqli_close($con);
        header("Location: consulta_especialidade.php");
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cancelar'])) {

        header("Location: consulta_especialidade.php");
        exit;

    }
    ?>
</body>
</html>
