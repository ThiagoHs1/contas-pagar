<?php 
require_once("../conexao.php");
require_once("verificar.php");
$pagina = 'caixa';

require_once($pagina."/campos.php");

?>

<div class="col-md-12 my-3">
	<a href="#" onclick="inserir()" type="button" class="btn btn-dark btn-sm">Nova Abertura</a>
</div>

<small>
	<div class="tabela bg-light" id="listar">

	</div>
</small>



<!-- Modal -->
<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><span id="tituloModal">Inserir Registro</span></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="form" method="post">
				<div class="modal-body">

					<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Valor da Abertura</label>
								<input type="number" class="form-control" name="<?php echo $campo2 ?>" placeholder="Valor da Abertura" id="<?php echo $campo2 ?>" value="0">
							</div>
					

					<small><div id="mensagem" align="center"></div></small>

					<input type="hidden" class="form-control" name="id"  id="id">


				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar">Fechar</button>
					<button type="submit" class="btn btn-primary">Salvar</button>
				</div>
			</form>
		</div>
	</div>
</div>




<!-- Modal -->
<div class="modal fade" id="modalExcluir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><span id="tituloModal">Excluir Registro</span></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="form-excluir" method="post">
				<div class="modal-body">

					Deseja Realmente excluir este Registro: <span id="nome-excluido"></span>?

					<?php require_once("verificar_adm.php"); ?>

					<small><div id="mensagem-excluir" align="center"></div></small>

					<input type="hidden" class="form-control" name="id-excluir"  id="id-excluir">


				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar-excluir">Fechar</button>
					<button type="submit" class="btn btn-danger">Excluir</button>
				</div>
			</form>
		</div>
	</div>
</div>






<!-- Modal -->
<div class="modal fade" id="modalFechar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><span id="tituloModal">Fechar Caixa</span></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="form-fechar" method="post">
				<div class="modal-body">

					Deseja Realmente fechar este caixa aberto dia: <span id="data_abert"></span>?

					<small><div id="mensagem-fechar" align="center"></div></small>

					<input type="hidden" class="form-control" name="id-fechar"  id="id-fechar">


				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar-fechar">Cancelar</button>
					<button type="submit" class="btn btn-success">Fechar Caixa</button>
				</div>
			</form>
		</div>
	</div>
</div>


//
<script type="text/javascript">var pag = "<?=$pagina?>"</script>
<script src="../js/ajax.js"></script>




<script>
	
	$("#form-fechar").submit(function () {
    event.preventDefault();
    var formData = new FormData(this);
    var pag = "<?=$pagina?>";
    $.ajax({
        url: pag + "/fechar-caixa.php",
        type: 'POST',
        data: formData,

        success: function (mensagem) {
            $('#mensagem-fechar').text('');
            $('#mensagem-fechar').removeClass()
            if (mensagem.trim() == "Fechado com Sucesso") {
                $('#btn-fechar-fechar').click();
                listar();
            } else {

                $('#mensagem-fechar').addClass('text-danger')
                $('#mensagem-fechar').text(mensagem)
            }


        },

        cache: false,
        contentType: false,
        processData: false,

    });

});

</script>



