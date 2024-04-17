<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Exclusão</title>
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

        p {
            color: #000; /* Texto preto */
            margin-bottom: 10px;
        }

        form {
            text-align: center;
            margin-top: 20px;
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
            margin-right: 10px;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: #4169E1; /* Azul royal */
        }
    </style>
</head>
<body>
    <h1>Exclusão Enfermeiro</h1>
    <?php

    if(isset($_GET['matricula'])) {
        include('conexao.php');
        $matricula = $_GET['matricula'];

        $query = "SELECT * FROM enfermeiro WHERE matricula = $matricula";
        $result = mysqli_query($con,$query);
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            echo "<p>ID: " . $row['matricula'] . "</p>";
            echo "<p>Nome: " . $row['nome'] . "</p>";
            
            echo "<p>Confirma a exclusão?</p>";
            echo "<form method='POST'>";
            echo "<input type='hidden' name='matricula' value='". $row['matricula'] . "'>";
            echo "<input type='submit' name='confirmar' value='Sim'>";
            echo "<input type='submit' name='cancelar' value='Não'>";
            echo "</form>";
        } else {
            echo "<p>Enfermeiro não encontrado.</p>";
        }

        mysqli_close($con);
       
    } 
    else {
        echo "<p>ID da enfermeiro não especificado.</p>";
    }
    ?>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirmar'])) {
        include('conexao.php');

        $matricula = $_POST['matricula'];
        $query = "DELETE FROM enfermeiro WHERE matricula = $matricula";
        $result = mysqli_query($con,$query);
        if ($result) {
            echo "<p>Enfermeiro excluído com sucesso!</p>";
        } else {
            echo "<p>ERRO ao excluir a enfermeiro: " . mysqli_error($con) . "</p>";
        }

        mysqli_close($con);
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cancelar'])) {
        header("Location: consulta_enfermeiro.php");
        exit;
    }
    ?>
</body>
</html>
