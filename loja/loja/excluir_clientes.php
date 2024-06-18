<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Exclusão de Cliente</title>
</head>
<body>
<h1>Exclusão de Cliente</h1>
<?php
    if (isset($_GET['id'])) {
        include('conexao.php');
        $id = $_GET['id'];
        $query = "SELECT * FROM clientes WHERE id = $id";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            echo "<p>ID: " . $row['id'] . "</p>";
            echo "<p>Nome: " . $row['nome'] . "</p>";
            echo "<p>Confirma a exclusão?</p>";
            echo "<form method='POST'>";
            echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
            echo "<input type='submit' name='confirmar' value='Sim'>";
            echo "<input type='submit' name='cancelar' value='Não'>";
            echo "</form>";
        } else {
            echo "Cliente não encontrado.";
        }
        mysqli_close($con);
    } else {
        echo "ID do cliente não especificado.";
    }
    ?>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirmar'])) {
        include('conexao.php');
        $id = $_POST['id'];
        $query = "DELETE FROM clientes WHERE id = $id";
        $result = mysqli_query($con, $query);
        if ($result) {
            echo "Cliente excluído com sucesso!";
        } else {
            echo "ERRO ao excluir o cliente: " . mysqli_error($con);
        }
        mysqli_close($con);
        header("Location: consulta_clientes.php");
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cancelar'])) {
        header("Location: consulta_clientes.php");
        exit;
    }
    ?>
</body>
</html>