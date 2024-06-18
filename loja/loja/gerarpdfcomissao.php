<?php
require_once __DIR__ . '/vendor/autoload.php';
use Mpdf\Mpdf;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'conexao.php';

    $data_inicio = $_POST['data_inicio'];
    $data_fim = $_POST['data_fim'];

    $query = "SELECT v.nome AS nome_vendedor, SUM(p.preco * ip.qtde) AS total_vendido, SUM((p.preco * ip.qtde) * (v.perc_comissao / 100)) AS comissao
              FROM pedidos ped
              INNER JOIN vendedor v ON ped.id_vendedor = v.id
              INNER JOIN itens_pedido ip ON ped.id = ip.id_pedido
              INNER JOIN produto p ON ip.id_produto = p.id
              WHERE ped.data BETWEEN '$data_inicio' AND '$data_fim'
              GROUP BY v.id";

    $result = mysqli_query($con, $query) or die(mysqli_error($con));

    if (mysqli_num_rows($result) > 0) {
        $mpdf = new Mpdf();

        ob_start();
        ?>
        <!DOCTYPE html>
        <html>
        <head>
        <meta charset="UTF-8">
        <title>Relatório de Comissão por Vendedor</title>
        </head>
        <body>
        <h1>Relatório de Comissão por Vendedor</h1>
        <p>Período: <?php echo $data_inicio . ' a ' . $data_fim; ?></p>
        <table border="1" width="100%">
            <tr>
                <td><b>Nome do Vendedor</b></td>
                <td><b>Total Vendido</b></td>
                <td><b>Comissão Recebida</b></td>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['nome_vendedor']; ?></td>
                    <td><?php echo $row['total_vendido']; ?></td>
                    <td><?php echo $row['comissao']; ?></td>
                </tr>
            <?php } ?>
        </table>
        </body>
        </html>
        <?php
        $html = ob_get_clean();

        $mpdf->WriteHTML($html);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->SetTitle('Relatório de Comissão por Vendedor');
        $mpdf->SetHeader('Relatório de Comissão por Vendedor');
        $mpdf->SetFooter('{PAGENO}');
        $mpdf->Output('relatorio_comissao_vendedor.pdf', 'D');
    } else {
        echo "Nenhum dado encontrado para o período selecionado.";
    }

    mysqli_close($con);
}
?>
