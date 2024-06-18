<?php
require_once __DIR__ . '/vendor/autoload.php';
use Mpdf\Mpdf;

if (isset($_POST['data_inicio']) && isset($_POST['data_fim'])) {
    require_once 'conexao.php';

    $data_inicio = mysqli_real_escape_string($con, $_POST['data_inicio']);
    $data_fim = mysqli_real_escape_string($con, $_POST['data_fim']);

    $query = "SELECT pedidos.id AS numero_pedido, pedidos.data, pedidos.id_cliente, pedidos.observacao, pedidos.forma_pagto, pedidos.prazo_entrega, pedidos.id_vendedor, clientes.nome AS nome_cliente, vendedor.nome AS nome_vendedor, produto.nome AS produto, produto.preco AS preco, itens_pedido.qtde AS quantidade 
              FROM pedidos 
              INNER JOIN clientes ON pedidos.id_cliente = clientes.id 
              INNER JOIN vendedor ON pedidos.id_vendedor = vendedor.id 
              INNER JOIN itens_pedido ON pedidos.id = itens_pedido.id_pedido 
              INNER JOIN produto ON itens_pedido.id_produto = produto.id
              WHERE pedidos.data BETWEEN '$data_inicio' AND '$data_fim'";

    $result = mysqli_query($con, $query) or die(mysqli_error($con));

    if (mysqli_num_rows($result) > 0) {
        $mpdf = new Mpdf();

        ob_start();
        ?>
        <!DOCTYPE html>
        <html>
        <head>
        <meta charset="UTF-8">
        <title>Relatório de Pedidos e Itens Vendidos</title>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
            }
            th, td {
                border: 1px solid black;
                padding: 8px;
                text-align: left;
            }
            th {
                background-color: #f2f2f2;
            }
        </style>
        </head>
        <body>
        <h1>Relatório de Pedidos e Itens Vendidos</h1>
        <p>Período: <?php echo $data_inicio . ' - ' . $data_fim; ?></p>
        <table border="1" width="100%">
        <tr>
            <th>ID</th>
            <th>Data</th>
            <th>Nome Cliente</th>
            <th>Observação</th>
            <th>Forma Pagto</th>
            <th>Prazo Entrega</th>
            <th>Nome Vendedor</th>
            <th>Itens do Pedido</th>
        </tr>
        <?php
        $current_order = null;

        while ($row = mysqli_fetch_assoc($result)) {
            if ($current_order !== $row['numero_pedido']) {
                if ($current_order !== null) {
                    echo "</table></td></tr>";
                }
                echo "<tr>";
                echo "<td>" . $row['numero_pedido'] . "</td>";
                echo "<td>" . $row['data'] . "</td>";
                echo "<td>" . $row['nome_cliente'] . "</td>";
                echo "<td>" . $row['observacao'] . "</td>";
                echo "<td>" . $row['forma_pagto'] . "</td>";
                echo "<td>" . $row['prazo_entrega'] . "</td>";
                echo "<td>" . $row['nome_vendedor'] . "</td>";
                echo "<td><table border='1' width='100%'>";
                echo "<tr><th>Produto</th><th>Preço</th><th>Quantidade</th></tr>";
                $current_order = $row['numero_pedido'];
            }
            echo "<tr>";
            echo "<td>" . $row['produto'] . "</td>";
            echo "<td>" . $row['preco'] . "</td>";
            echo "<td>" . $row['quantidade'] . "</td>";
            echo "</tr>";
        }

        if ($current_order !== null) {
            echo "</table></td></tr>";
        }
        ?>
        </table>
        </body>
        </html>
        <?php
        $html = ob_get_clean();

        $mpdf->WriteHTML($html);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->SetTitle('Relatório de Pedidos e Itens Vendidos');
        $mpdf->SetHeader('Relatório de Pedidos e Itens Vendidos');
        $mpdf->SetFooter('{PAGENO}');
        $mpdf->Output('relatorio_pedidos_e_itens_vendidos.pdf', 'D');
    } else {
        echo "Nenhum resultado encontrado para o período especificado.";
    }

    mysqli_close($con);
} else {
    echo "Por favor, preencha o período de data inicial e final.";
}
?>
