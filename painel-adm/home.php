<?php 

require_once('../conexao.php');
require_once('verificar.php');

$hoje = date('Y-m-d');
$mes_atual = Date('m');
$ano_atual = Date('Y');
$dataInicioMes = $ano_atual."-".$mes_atual."-01";



$query = $pdo->query("SELECT * from contas_receber where vencimento < curDate() and status != 'Paga'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$contas_receber_vencidas = @count($res);


$query = $pdo->query("SELECT * from contas_receber where vencimento = curDate() and status != 'Paga'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$contas_receber_hoje = @count($res);



$query = $pdo->query("SELECT * from contas_pagar where vencimento < curDate() and status != 'Paga'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$contas_pagar_vencidas = @count($res);


$query = $pdo->query("SELECT * from contas_pagar where vencimento = curDate() and status != 'Paga'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$contas_pagar_hoje = @count($res);


$totalPagarM = 0;
		$query = $pdo->query("SELECT * from contas_pagar where vencimento >= '$dataInicioMes' and vencimento <= curDate() and status = 'Pendente'");
		$res = $query->fetchAll(PDO::FETCH_ASSOC);
		$pagarMes = @count($res);
		$total_reg = @count($res);
		if($total_reg > 0){ 

			for($i=0; $i < $total_reg; $i++){
				foreach ($res[$i] as $key => $value){	}

					$totalPagarM += $res[$i]['valor'];
				$pagarMesF = number_format($totalPagarM, 2, ',', '.');

			}
		}


		$totalReceberM = 0;
		$query = $pdo->query("SELECT * from contas_receber where vencimento >= '$dataInicioMes' and vencimento <= curDate() and status = 'Pendente'");
		$res = $query->fetchAll(PDO::FETCH_ASSOC);
		$receberMes = @count($res);
		$total_reg = @count($res);
		if($total_reg > 0){ 

			for($i=0; $i < $total_reg; $i++){
				foreach ($res[$i] as $key => $value){	}

					$totalReceberM += $res[$i]['valor'];
				$receberMesF = number_format($totalReceberM, 2, ',', '.');

			}
		}

		

?>

<link rel="stylesheet" type="text/css" href="../css/estilo-home.css"/>
<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

<div class="container-fluid">
	<section id="minimal-statistics">
		<div class="row mb-2">
			<div class="col-12 mt-3 mb-1">
				<h4 class="text-uppercase">Dados do Sistema</h4>

			</div>
		</div>

		<div class="row mb-4">

			<div class="col-xl-3 col-sm-6 col-12"> 
				<div class="card "style="border-radius: 40px; " >
					<div class="card-content">
						<div class="card-body">
							<div class="row">
								<div class="align-self-center col-3">
									<img src="../img/calendar.png"  width="80px" height="80px" alt="" srcset="">
								</div>
								<div class="col-9 text-end">
								<h3> <span class=""><?php echo @$contas_pagar_hoje ?></span></h3>
									<span>Contas à Pagar (Hoje)</span>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-xl-3 col-sm-6 col-12"> 
				<div class="card  " style="border-radius: 40px; ">
					<div class="card-content ">
						<div class="card-body ">
							<div class="row">
								<div class="align-self-center col-3">
								<img src="../img/calendarvencidas.png"  width="80px" height="80px" alt="" srcset="">
								</div>
								<div class="col-9 text-end">
								<h3> <?php echo @$contas_pagar_vencidas ?></span></h3>
										<span>Contas à Pagar Vencidas</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>


				<div class="col-xl-3 col-sm-6 col-12"> 
					<div class="card" style="border-radius: 40px; ">
						<div class="card-content">
							<div class="card-body">
								<div class="row">
									<div class="align-self-center col-3">
									<img src="../img/calendareceber.png"  width="80px" height="80px" alt="" srcset="">
									</div>
									<div class="col-9 text-end">
										<h3> <span class=""><?php echo @$contas_receber_hoje ?></span></h3>
										<span>Contas Receber (Hoje)</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>


				<div class="col-xl-3 col-sm-6 col-12"> 
					<div class="card " style="border-radius: 40px; ">
						<div class="card-content">
							<div class="card-body">
								<div class="row">
									<div class="align-self-center col-3">
									<img src="../img/calendarvencidas.png"  width="80px" height="80px" alt="" srcset="">
									</div>
									<div class="col-9 text-end">
										<h3><?php echo @$contas_receber_vencidas ?></h3>
										<span>Contas à Receber Vencidas</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				

			</div>



		</section>

		<section id="stats-subtitle">
			<div class="row mb-2">
				<div class="col-12 mt-3 mb-1">
					<h4 class="text-uppercase">Dados Mensais</h4>

				</div>
			</div>

		</section>


		<div class="row mb-4">

	

	
<div class="col-xl-6 col-md-12 ">
		<div class="card  overflow-hidden" style="border-radius: 40px; ">
			<div class="card-content ">
				<div class="card-body cleartfix">
					<div class="row media align-items-stretch">
						<div class="align-self-center col-1">
						<img src="../img/calendarpagar.png"  width="80px" height="80px" alt="" srcset="">
						</div>
						<div class="media-body text-md-center col-6">
							<h4>Contas à Pagar</h4>
							<span>Total de <?php echo @$pagarMes ?> Contas no Mês</span>
						</div>
						<div class="text-end col-5">
							<h2>R$ <?php echo @$pagarMesF ?></h2>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>


<div class="row mb-4" >

	<div class="col-xl-6 col-md-12 " >
		<div class="card "  style="border-radius: 40px; ">
			<div class="card-content">
				<div class="card-body cleartfix ">
					<div class="row media align-items-stretch ">
						<div class="align-self-center col-1">
						<img src="../img/calendarmes.png"  width="80px" height="80px" alt="" srcset="">
						</div>
						<div class="media-body text-md-center col-6">
										<h4>Contas à Receber</h4>
										<span>Total de <?php echo @$receberMes ?> Contas no Mês</span>
									</div>
									<div class="text-end col-5">
										<h2>R$ <?php echo @$receberMesF ?></h2>
									</div>
					</div>
				</div>
			</div>
		</div>
	</div>


</div>



</div>


