<?php 

$nome_sistema = 'Stardust-Financeiro';
$url_sistema = 'http://localhost/tcc/';
$email_adm = 'thiago.sh26@gmail.com';
$nome_admin = 'Thiago H';



//DADOS PARA O BANCO DADOS LOCAL
$servidor = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'tcc';





//VARIAVEIS PARA CONTAS A RECEBER   OBS NAO COLOQUE % NOS VALORES
$valor_multa = 2; // esse valor de 2 corresponde a 2% sobre o valor da venda
$valor_juros_dia = 0.15; // aqui será 0.15 % ao dia sobre o valor da venda;
$dias_carencia = 0;

$frequencia_automatica = 'Não';
$relatorio_pdf = 'Sim';
 ?>