<?php
include 'conexao.php';

$result_clientes = mysqli_query($con, "SELECT id, nome FROM clientes");
$result_vendedores = mysqli_query($con, "SELECT id, nome FROM vendedor");
$result_produtos = mysqli_query($con, "SELECT id, nome, preco, qtde_estoque FROM produto");
$result_formas_pagto = mysqli_query($con, "SELECT id, nome FROM forma_pagto");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    mysqli_begin_transaction($con);

    $data = $_POST['data'];
    $id_cliente = $_POST['id_cliente'];
    $observacao = $_POST['observacao'];
    $forma_pagto_id = $_POST['forma_pagto']; 
    $prazo_entrega = $_POST['prazo_entrega'];
    $id_vendedor = $_POST['id_vendedor'];

    $sql_pedido = "INSERT INTO pedidos (data, id_cliente, observacao, forma_pagto, prazo_entrega, id_vendedor) 
                   VALUES ('$data', '$id_cliente', '$observacao', '$forma_pagto_id', '$prazo_entrega', '$id_vendedor')";
    if (mysqli_query($con, $sql_pedido)) {
        $id_pedido = mysqli_insert_id($con); 

        $id_produto = $_POST['id_produto'];
        $qtde = $_POST['qtde'];

        $erro = false; 

        foreach ($id_produto as $key => $value) {
            $id_produto_atual = $id_produto[$key];
            $result_preco_produto = mysqli_query($con, "SELECT preco FROM produto WHERE id = '$id_produto_atual'");
            $row_preco_produto = mysqli_fetch_assoc($result_preco_produto);
            $preco_produto = $row_preco_produto['preco'];

            $sql_itens_pedido = "INSERT INTO itens_pedido (id_pedido, id_produto, qtde ) 
                                 VALUES ('$id_pedido', '$id_produto_atual', '{$qtde[$key]}')";
            if (!mysqli_query($con, $sql_itens_pedido)) {
                $erro = true;
                break; 
            }
        }

        if ($erro) {
            mysqli_rollback($con);
            echo "Erro ao incluir itens do pedido. Transação revertida.";
        } else {
            mysqli_commit($con);
            echo "Pedido e itens incluídos com sucesso!";
        }
    } else {
        mysqli_rollback($con);
        echo "Erro ao incluir pedido: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incluir Pedido</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
            padding: 0;
            background-color: #f2f2f2;
        }

        h2 {
            color: #333;
        }
        h1 {
            color: #333;
        }


        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            max-width: 600px;
            margin: auto;
        }

        input[type="date"], input[type="text"], select, input[type="number"] {
            width: calc(100% - 20px);
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }

        select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background: transparent url('arrow.png') no-repeat right center;
        }

        button, input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        button:hover, input[type="submit"] {
            background-color: #45a049;
        }

        #itens_pedido {
            margin-top: 10px;
        }

        #produto_selecionado {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f9f9f9;
        }
    </style>
    <script>
        function updateProdutoInfo(select) {
            var selectedOption = select.options[select.selectedIndex];
            var qtde_estoque = selectedOption.getAttribute('data-qtde_estoque');
            document.getElementById('preco_produto').innerText = selectedOption.getAttribute('data-preco');
            document.getElementById('qtde_produto').setAttribute('max', qtde_estoque);
        }

        function adicionarProduto() {
            var div = document.createElement('div');
            div.innerHTML = document.getElementById('produto_selecionado').innerHTML;
            document.getElementById('itens_pedido').appendChild(div);
        }
    </script>
</head>
<body>
    <h1>Incluir Pedido</h1>
    <form action="incluir_pedido.php" method="post">
        <h3>Pedido</h3>
        Data: <input type="date" name="data" required><br>
        Cliente: 
        <select name="id_cliente" required>
            <?php
            while ($row = mysqli_fetch_assoc($result_clientes)) {
                echo "<option value='{$row['id']}'>{$row['nome']}</option>";
            }
            ?>
        </select><br>
        Observação: <input type="text" name="observacao"><br>
        Forma de Pagamento: 
        <select name="forma_pagto" required>
            <?php
            while ($row = mysqli_fetch_assoc($result_formas_pagto)) {
                echo "<option value='{$row['id']}'>{$row['nome']}</option>";
            }
            ?>
        </select><br>
        Prazo de Entrega: <input type="text" name="prazo_entrega"><br>
        Vendedor: 
        <select name="id_vendedor" required>
            <?php
            while ($row = mysqli_fetch_assoc($result_vendedores)) {
                echo "<option value='{$row['id']}'>{$row['nome']}</option>";
            }
            ?>
        </select><br>
        <h3>Itens do Pedido</h3>
        <div id="itens_pedido">
            <div id="produto_selecionado">
                Produto: 
                <select name="id_produto[]" required onchange="updateProdutoInfo(this)">
                    <option value="">Selecione um produto</option>
                    <?php
                    mysqli_data_seek($result_produtos, 0); 
                    while ($row = mysqli_fetch_assoc($result_produtos)) {
                        echo "<option value='{$row['id']}' data-preco='{$row['preco']}' data-qtde_estoque='{$row['qtde_estoque']}'>{$row['nome']}</option>";
                    }
                    ?>
                </select><br>
               
                Quantidade: <input type="number" name="qtde[]" id="qtde_produto" required><br>
            </div>
        </div>
        <button type="button" onclick="adicionarProduto()">Adicionar novo Produto</button>
        <input type="submit" value="Incluir Pedido">
    </form>
</body>
</html>
