$(document).ready(function() {
    listar();

} );


function excluir(id, nome){
    $('#id-excluir').val(id);
    $('#nome-excluido').text(nome);
    var myModal = new bootstrap.Modal(document.getElementById('modalExcluir'), {       });
    myModal.show();
    $('#mensagem-excluir').text('');
}



function inserir(){
    $('#mensagem').text('');
    $('#tituloModal').text('Inserir Registro');
    var myModal = new bootstrap.Modal(document.getElementById('modalForm'), {
        backdrop: 'static',
    });
    myModal.show();
    limparCampos();
}



$("#form").submit(function () {
	event.preventDefault();
	var formData = new FormData(this);

	$.ajax({
		url: pag + "/inserir.php",
		type: 'POST',
		data: formData,

		success: function (mensagem) {
            $('#mensagem').text('');
            $('#mensagem').removeClass()
            if (mensagem.trim() == "Salvo com Sucesso") {
                 
                    $('#btn-fechar').click();
                    listar();
                } else {

                	$('#mensagem').addClass('text-danger')
                    $('#mensagem').text(mensagem)
                }


            },

            cache: false,
            contentType: false,
            processData: false,
            
        });

});



function listar(){
    $.ajax({
        url: pag + "/listar.php",
        method: 'POST',
        data: $('#form').serialize(),
        dataType: "html",

        success:function(result){
            $("#listar").html(result);
        }
    });
}




$("#form-excluir").submit(function () {
    event.preventDefault();
    var formData = new FormData(this);
    
    $.ajax({
        url: pag + "/excluir.php",
        type: 'POST',
        data: formData,

        success: function (mensagem) {
            $('#mensagem-excluir').text('');
            $('#mensagem-excluir').removeClass()
            if (mensagem.trim() == "Excluído com Sucesso") {
                $('#btn-fechar-excluir').click();
                listar();
                limparCampos();
            } else {

                $('#mensagem-excluir').addClass('text-danger')
                $('#mensagem-excluir').text(mensagem)
            }


        },

        cache: false,
        contentType: false,
        processData: false,

    });

});





function mudarStatus(id, ativar){
    
    $.ajax({
        url: pag + "/mudar-status.php",
        method: 'POST',
        data: {id, ativar},
        dataType: "text",

        success: function (mensagem) {
            if (mensagem.trim() == "Alterado com Sucesso") {
                listar();
            }               
        },

    });
}







function parcelar(id, descricao, valor){
    $('#id-parcelar').val(id);
    $('#descricao-parcelar').text(descricao);
    $('#valor-parcelar').val(valor);
    $('#qtd-parcelar').val('');

    
    var myModal = new bootstrap.Modal(document.getElementById('modalParcelar'), {       });
    myModal.show();
    $('#mensagem-parcelar').text('');
}




$("#form-parcelar").submit(function () {
    event.preventDefault();
    var formData = new FormData(this);
    
    $.ajax({
        url: pag + "/parcelar.php",
        type: 'POST',
        data: formData,

        success: function (mensagem) {
            $('#mensagem-parcelar').text('');
            $('#mensagem-parcelar').removeClass()
            if (mensagem.trim() == "Parcelado com Sucesso") {
                $('#btn-fechar-parcelar').click();
                listar();
                limparCampos();
            } else {

                $('#mensagem-parcelar').addClass('text-danger')
                $('#mensagem-parcelar').text(mensagem)
            }


        },

        cache: false,
        contentType: false,
        processData: false,

    });

});





function baixar(id, descricao, valor, saida){
    $('#id-baixar').val(id);
    $('#descricao-baixar').text(descricao);
    $('#valor-baixar').val(valor);
    $('#saida-baixar').val(saida);
     $('#subtotal').val(valor);

    $('#juros-baixar').val('');
    $('#desconto-baixar').val('');
    $('#multa-baixar').val('');
       
    var myModal = new bootstrap.Modal(document.getElementById('modalBaixar'), {       });
    myModal.show();
    $('#mensagem-baixar').text('');
}




$("#form-baixar").submit(function () {
    event.preventDefault();
    var formData = new FormData(this);
    
    $.ajax({
        url: pag + "/baixar.php",
        type: 'POST',
        data: formData,

        success: function (mensagem) {
            $('#mensagem-baixar').text('');
            $('#mensagem-baixar').removeClass()
            if (mensagem.trim() == "Baixado com Sucesso") {
                $('#btn-fechar-baixar').click();
                listar();
                limparCampos();
            } else {

                $('#mensagem-baixar').addClass('text-danger')
                $('#mensagem-baixar').text(mensagem)
            }


        },

        cache: false,
        contentType: false,
        processData: false,

    });

});