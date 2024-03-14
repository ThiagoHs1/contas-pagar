<?php 
require_once("../../conexao.php");
require_once("campos.php");
@session_start();
$id_usuario = $_SESSION['id_usuario'];

$id = $_POST['id-baixar'];
$valor = $_POST['valor-baixar'];
$valor = str_replace(',', '.', $valor);

$saida = $_POST['saida-baixar'];

$query = $pdo->query("SELECT * from $pagina where id = '$id' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id = $res[0]['id'];
$cp1 = $res[0]['descricao'];
$cp3 = $res[0]['saida'];
$cp4 = $res[0]['documento'];
$cp5 = $res[0]['plano_conta'];
$cp9 = $res[0]['valor'];


//RECUPERAR O CAIXA QUE ESTÁ ABERTO (CASO TENHA ALGUM)
$query2 = $pdo->query("SELECT * FROM caixa WHERE status = 'Aberto'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$caixa_aberto = $res2[0]['id'];
}else{
	$caixa_aberto = 0;
}

if($valor > $cp9){
	echo 'O valor a ser pago não pode ser superior ao valor da conta! O valor da conta é de R$ '.$cp9;
	exit();
}

if($valor <= 0){
	echo 'O precisa ser maior que 0 ';
	exit();
}


if($valor == $cp9){

	$pdo->query("UPDATE $pagina set saida = '$saida', usuario_baixa = '$id_usuario', status = 'Paga', data_baixa = curDate() where id = '$id'");

	

}else{

	//PEGAR RESIDUOS DA CONTA
	$total_resid = 0;
	$query = $pdo->query("SELECT * FROM valor_parcial WHERE id_conta = '$id'");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	if(@count($res) > 0){
	
		for($i=0; $i < @count($res); $i++){
		foreach ($res[$i] as $key => $value){} 
			$valor_resid = $res[$i]['valor'];
			$total_resid += $valor_resid;
		}
	}else{
		$cp1 = '(Resíduo) - ' .$cp1;
	}

	$cp9 = $cp9 - $subtotal;

	$pdo->query("INSERT INTO valor_parcial set id_conta = '$id', tipo = 'Pagar', valor = '$subtotal', data = curDate(), usuario = '$id_usuario'");

	$pdo->query("UPDATE $pagina set descricao = '$cp1', saida = '$saida', usuario_baixa = '$id_usuario', status = 'Pendente',  valor = '$cp9', subtotal  data_baixa = curDate() where id = '$id'");

}

echo 'Baixado com Sucesso!';

?>