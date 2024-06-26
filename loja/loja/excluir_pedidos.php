<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Exclusão de Pedido</title>
</head>
<body>
<h1>Exclusão de Pedido</h1>
<?php
    if (isset($_GET['id'])) {
        include('conexao.php');
        $id = $_GET['id'];
        $query = "SELECT * FROM pedidos WHERE id = $id";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            echo "<p>ID: " . $row['id'] . "</p>";
            echo "<p>Data: " . $row['data'] . "</p>";
            echo "<p>ID Cliente: " . $row['id_cliente'] . "</p>";
            echo "<p>Observação: " . $row['observacao'] . "</p>";
            echo "<p>Forma de Pagamento: " . $row['forma_pagto'] . "</p>";
            echo "<p>Prazo de Entrega: " . $row['prazo_entrega'] . "</p>";
            echo "<p>ID Vendedor: " . $row['id_vendedor'] . "</p>";
            echo "<p>Confirma a exclusão?</p>";
            echo "<form method='POST'>";
            echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
            echo "<input type='submit' name='confirmar' value='Sim'>";
            echo "<input type='submit' name='cancelar' value='Não'>";
            echo "</form>";
        } else {
            echo "Pedido não encontrado.";
        }
        mysqli_close($con);
    } else {
        echo "ID do pedido não especificado.";
    }
    ?>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirmar'])) {
        include('conexao.php');

       
        mysqli_begin_transaction($con);

        $id = $_POST['id'];


        $query_delete_itens = "DELETE FROM itens_pedido WHERE id_pedido = $id";
        $result_delete_itens = mysqli_query($con, $query_delete_itens);

        $query_delete_pedido = "DELETE FROM pedidos WHERE id = $id";
        $result_delete_pedido = mysqli_query($con, $query_delete_pedido);

        if ($result_delete_itens && $result_delete_pedido) {
         
            mysqli_commit($con);
            echo "Pedido excluído com sucesso!";
            header("Location: consulta_pedido.php");
        } else {
            
            mysqli_rollback($con);
            echo "ERRO ao excluir o pedido: " . mysqli_error($con);
        }
        mysqli_close($con);
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cancelar'])) {
        header("Location: consulta_pedido.php");
        exit;
    }
    ?>
</body>
</html>
