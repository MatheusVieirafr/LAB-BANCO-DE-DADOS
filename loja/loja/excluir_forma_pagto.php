<!DOCTYPE>
<html>
<head>
    <meta charset="UTF-8">
    <title>Exclusão</title>
</head>
<body>
    <h1>Exclusão</h1>
    <?php

    if(isset($_GET['id'])) {
        include('conexao.php');
        $id = $_GET['id'];

        $query = "SELECT * FROM forma_pagto WHERE id = $id";
        $result = mysqli_query($con,$query);
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            echo "<p>ID: " . $row['id'] . "</p>";
            echo "<p>Descrição: " . $row['nome'] . "</p>";
            
            echo "<p>Confirma a exclusão?</p>";
            echo "<form method='POST'>";
            echo "<input type = 'hidden' name = 'id' value = '". $row['id'] . "'>";
            echo "<input type = 'submit' name = 'confirmar' value= 'Sim'>";
            echo "<input type = 'submit' name = 'cancelar' value= 'Não'>";
            echo "</form>";
        } else {
            echo "funcao não encontrada.";
        }

        mysqli_close($con);
       
    } 
    else {
        echo "ID da especialidade não especificado.";
    }
    ?>
    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirmar'])) {
        include('conexao.php');

        $id = $_POST['id'];
        $query = "DELETE FROM forma_pagto WHERE id = $id";
        $result = mysqli_query($con,$query);
        if ($result) {
            echo "Especialidade excluída com sucesso!";
        } else {
            echo "ERRO ao excluir a forma_pagto: " . mysqli_error($con);
        }

        mysqli_close($con);
    
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cancelar'])) {
        header("Location: consulta_forma_pagto.php");
        exit;
    }
    ?>
</body>
</html>