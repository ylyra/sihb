function addInput(place) {
    let valor = c(`.${place}`).childElementCount;
    let modelo_input = c('#exemplos #add_register').cloneNode(true)
    modelo_input.querySelector('label').setAttribute('for', `nickname-${valor}`)
    modelo_input.querySelector('input').setAttribute('id', `nickname-${valor}`)
    c(`.${place}`).append(modelo_input)
}

function removeInput(obj) {
    obj.closest('#add_register').remove()
}


function buscarTipoTreino(obj) {
    let valor = obj.querySelector('form#opcoes-tipo input[type=radio]:checked').value
    let url = `${BASE}relatorios/getCriar`
	let params = {
		method: 'POST',
		body: JSON.stringify({
			valor
		})

	}
	fetch(url, params)
		.then((r) => r.text())
		.then((html) => {
			c('#relatorio').innerHTML = html
		})
		.catch((erro) => {
			// erro em falhas
		})
}

$(function(e) {
    "use strict";
    $(".date-inputmask").inputmask("99/99/9999"),
    $(".phone-inputmask").inputmask("(99) 9 9999-9999"),
    $(".international-inputmask").inputmask("+9(999)999-9999"),
    $(".xphone-inputmask").inputmask("(999) 999-9999 / x999999"),
    $(".purchase-inputmask").inputmask("aaaa 9999-****"),
    $(".cc-inputmask").inputmask("9999 9999 9999 9999"),
    $(".ssn-inputmask").inputmask("999-99-9999"),
    $(".isbn-inputmask").inputmask("999-99-999-9999-9"),
    $(".currency-inputmask").inputmask("$9999"),
    $(".percentage-inputmask").inputmask("99%"),
    $(".decimal-inputmask").inputmask({
        alias: "decimal",
        radixPoint: "."
    })
});

function updateNoticia(obj) {
    let titulo = obj.querySelector('#titulo').value
    let subtitulo = obj.querySelector('#subtitulo').value
    let banner = obj.querySelector('#banner').value
    let categoria = obj.querySelector('#categoria').value
    let texto = obj.querySelector('#texto2').value
    let id = obj.querySelector('#id').value
    let tipo = 1

    $.ajax({
        url:`${BASE}jornal/updateCriacao`,
        type:'POST',
        data:{
            titulo,
            subtitulo,
            banner,
            categoria,
            texto,
            id,
            tipo
        },
        success:function() {
        },
        error:function() {

        }
    });	   
}