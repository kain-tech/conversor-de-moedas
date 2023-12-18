<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <title>Resultado 03</title>
</head>
<body>
    <header>
        <h1>Conversor de moedas v0.2</h1>
    </header>

    <main>
        <?php 
            //Ajustando a data do inicio da cotação para 7 dias atras do dia atual
            $_inicio = date("m-d-Y", strtotime("-7 days"));

            //Ajustando a data atual da cotação
            $_fim = date("m-d-Y");

            //puxando a cotação direto do site banco central do brasil via link json
            $_url = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarPeriodo(dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@dataInicial=\''.$_inicio.'\'&@dataFinalCotacao=\''.$_fim.'\'&$top=1&$format=json&$select=cotacaoCompra,dataHoraCotacao';

            //decodificando e lendo o link json
            $_dados = json_decode(file_get_contents($_url), true);

            // separando somente o valor da cotação do link json
            $_cotacao = $_dados["value"][0]["cotacaoCompra"];

            //recuperando o valor inserido pelo usuario
            $_r = $_GET["reais"] ?? 0;

            //dividindo o valor em real pelo valor da cotação
            $_d = $_r / $_cotacao;

            //exibindo resultados
            echo "<p>Seus R$" . number_format($_r, 2, "," , ".") . " Equivalem a US$" . number_format($_d, 2, "," , ".");
        ?>
         
        <!--link do site banco central do brasil-->
        <p>A cotação foi retirada do site <a href="https://www.bcb.gov.br/">Banco Central do Brasil</a></p>
    </main>
</body>
</html>