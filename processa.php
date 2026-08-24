<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.html");
    exit;
}

$nome = $_POST["txtNome"] ?? "";
$valorCompra = floatval($_POST["txtValorCompra"] ?? 0);
$formaPagamento = $_POST["cmbPag"] ?? "";

$desconto = 0;
$percentualDesconto = 0;
$descricaoPagamento = "";


if ($formaPagamento == "deposito") {

    $percentualDesconto = 10;
    $desconto = $valorCompra * 0.10;
    $descricaoPagamento = "Depósito";

} elseif ($formaPagamento == "boleto") {

    $percentualDesconto = 8;
    $desconto = $valorCompra * 0.08;
    $descricaoPagamento = "Boleto";

} elseif ($formaPagamento == "cartaoCredito") {

    $percentualDesconto = 0;
    $desconto = 0;
    $descricaoPagamento = "Cartão de crédito";

} else {

    echo "Forma de pagamento inválida.";
    exit;
}


$valorFinal = $valorCompra - $desconto;


$valorCompraFormatado =
    number_format($valorCompra, 2, ",", ".");

$descontoFormatado =
    number_format($desconto, 2, ",", ".");

$valorFinalFormatado =
    number_format($valorFinal, 2, ",", ".");

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Resultado - Madeira e Cia</title>

    <link rel="stylesheet" href="estilo.css">

</head>

<body>

    <div class="container">

        <h1>Resultado da Compra</h1>

        <div class="informacao">
            <strong>Cliente:</strong>
            <?php echo htmlspecialchars($nome); ?>
        </div>

        <div class="informacao">
            <strong>Forma de pagamento:</strong>
            <?php echo $descricaoPagamento; ?>
        </div>

        <div class="informacao">
            <strong>Valor da compra:</strong>
            R$ <?php echo $valorCompraFormatado; ?>
        </div>

        <div class="informacao">
            <strong>Desconto:</strong>
            <?php echo $percentualDesconto; ?>%
            (R$ <?php echo $descontoFormatado; ?>)
        </div>

        <div class="final">

            <p>Valor final da compra:</p>

            <strong>
                R$ <?php echo $valorFinalFormatado; ?>
            </strong>

        </div>

        <p class="mensagem">

            Olá
            <?php echo htmlspecialchars($nome); ?>!

            Sua compra foi calculada com sucesso.

        </p>

        <a class="voltar" href="index.html">
            Nova compra
        </a>

    </div>

</body>

</html>