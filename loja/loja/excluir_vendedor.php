<!DOCTYPE html>
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
        $query = "SELECT * FROM vendedor WHERE id = $id";
        $result = mysqli_query($con,$query);
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            echo "<p>ID: " . $row['id'] . "</p>";
            echo "<p>Nome: " . $row['nome'] . "</p>";
            echo "<p>Endereço: " . $row['endereco'] . "</p>";
            echo "<p>Cidade: " . $row['cidade'] . "</p>";
            echo "<p>Estado: " . $row['estado'] . "</p>";
            echo "<p>Celular: " . $row['celular'] . "</p>";
            echo "<p>Email: " . $row['email'] . "</p>";
            echo "<p>Porcentagem de Comissão: " . $row['perc_comissao'] . "</p>";
            echo "<p>Confirma a exclusão?</p>";
            echo "<form method='POST'>";
            echo "<input type='hidden' name='id' value='". $row['id'] . "'>";
            echo "<input type='submit' name='confirmar' value='Sim'>";
            echo "<input type='submit' name='cancelar' value='Não'>";
            echo "</form>";
        } else {
            echo "Vendedor não encontrado.";
        }
        mysqli_close($con);
    }
    else {
        echo "ID do vendedor não especificado.";
    }
    ?>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirmar'])) {
        include('conexao.php');
        $id = $_POST['id'];
        $query = "DELETE FROM vendedor WHERE id = $id";
        $result = mysqli_query($con,$query);
        if ($result) {
            echo "Vendedor excluído com sucesso!";
        } else {
            echo "ERRO ao excluir o vendedor: " . mysqli_error($con);
        }
        mysqli_close($con);
        
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cancelar'])) {
        header("Location: consulta_vendedor.php");
        exit;
    }
    ?>
</body>
</html>