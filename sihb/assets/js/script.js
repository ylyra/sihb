function sleep(ms) {
	return new Promise(resolve => setTimeout(resolve, ms));
}

$radio = c('.radio')
const Radio = {
	r:c('#radio_player'),
	play() {
		this.r.play()
	},
	pause() {
		this.r.pause()
		localStorage.volumeRadio = 0
	},
	volume(value) {
		this.r.volume = value
		this.play()
	}
}

const ForumMsgs = {
    page: 2,
    continue: true,
    search() {
		let cat = c('.forum #posts-list').getAttribute('data-cat')
        let url = `${BASE}ajax/forum_msgs`
            let params = {
                method: 'POST',
                body: JSON.stringify({
                    page: ForumMsgs.page,
                    cat: cat
                })

            }
            fetch(url, params)
                .then((r) => r.json())
                .then((json) => {
                    if (json.status == 1) {
						c('.forum #posts-list').innerHTML = ''
                        json.noticias.map((item, index) => {
							let modelo_noticia = c('#clones-itens .post').cloneNode(true)
							
							if (item.status == 2) {
								modelo_noticia.classList.add('fixa')
							}

                            // modelo_noticia.href = `${BASE}noticia/${item.id}/${item.slug}`

                            modelo_noticia.querySelector('.avatar img').src = `http://www.habbo.com.br/habbo-imaging/avatarimage?&user=${item.autor}&action=std&direction=4&head_direction=3&img_format=png&gesture=std&headonly=1&size=b`

                            modelo_noticia.querySelector('.ml-10 p a').href = `${BASE}forum/abrir/${item.id}/${item.slug}`
							modelo_noticia.querySelector('.ml-10 p a span').innerHTML = `${item.titulo}`

							modelo_noticia.querySelector('.ml-10 .infos #clone-por').innerHTML = `<i class="fa fa-user"></i>&nbsp;&nbsp;${item.autor}`
							
							modelo_noticia.querySelector('.ml-10 .infos #clone-hora').innerHTML = `<i class="fa fa-calendar"></i>&nbsp;&nbsp;${item.postado_a}`
							
                            modelo_noticia.querySelector('.ml-10 .infos #clone-total span').innerText = `${item.respostas}`
                            
                            c(".forum #posts-list").append(modelo_noticia)
						})
						
						c('.categorias-footer #pag-atual').innerHTML = this.page

						this.page = json.page
                        this.continue = true						
                    } else {
                        this.continue = false
                    }
                })
                .catch((erro) => {
                    // erro em falhas
                })
	},
	goBaack() {
		if (ForumMsgs.page >= 3) {
			ForumMsgs.page = ForumMsgs.page - 2;
			ForumMsgs.search()
		}
	},
	goForward() {
		ForumMsgs.search()
	}
}

function estrela(num) {
    
    for(let i=1; i<=num; i++) {
        c(`.avaliar-nota button:nth-child(${i}) img`).src = 'https://i.imgur.com/W00XN28.png'
    }

    for(let i=5; i>num; i--) {
        c(`.avaliar-nota button:nth-child(${i}) img`).src = 'https://i.imgur.com/hHOja9j.png'
    }
}

function removerEstrelas() {
    for(let i=5; i>0; i--) {
        c(`.avaliar-nota button:nth-child(${i}) img`).src = 'https://i.imgur.com/hHOja9j.png'
    }
}

function votarNoticia(id_noticia, quantidade) {
	let url = `${BASE}ajax/votar_noticia`
	let params = {
		method: 'POST',
		body: JSON.stringify({
			id_noticia,
			quantidade
		})

	}
	fetch(url, params)
		.then(() => {
			cs('.avalie .avalie-footer .avaliar-nota button').forEach((item)=>{
				item.removeAttribute('onmouseover')
				item.removeAttribute('onclick')
			})

			c('.avalie .avalie-footer .avaliar-nota').removeAttribute('onmouseout')
			for(let i=1; i<=quantidade; i++) {
				c(`.avaliar-nota button:nth-child(${i}) img`).src = 'https://i.imgur.com/W00XN28.png'
			}
			c('.avalie .avalie-footer #seu-voto').innerHTML = `${quantidade}.0`
		})
		.catch((erro) => {
			// erro em falhas
		})
}

function curtirComentarioN(id_comentario, id_registro, tipo, id_noticia) {
	let comentario = c(`.comentarios .comentario#comentario-${id_comentario}`)

	let botao = comentario.querySelector(`.comentario-info .info .botoes button:nth-child(${tipo})`)

	let valor_atual = parseInt(botao.querySelector('span').innerHTML)
	
	let url = `${BASE}ajax/curtir_comentario`
	let params = {
		method: 'POST',
		body: JSON.stringify({
			id_comentario,
			id_registro,
			tipo,
			id_noticia
		})

	}
	fetch(url, params)
		.then(() => {
			comentario.querySelectorAll('.comentario-info .info .botoes button').forEach((item)=>{
				item.removeAttribute('onclick')
			})
			botao.querySelector('span').innerHTML = valor_atual + 1
			botao.classList.add('active')
		})
		.catch((erro) => {
			// erro em falhas
		})
}

function getRegistro() {
	let nickname = c('#busca-registro form #nickname').value;
	let url = `${BASE}ajax/pesquisar`
	let params = {
		method: 'POST',
		body: JSON.stringify({
			nickname: nickname
		})

	}
	fetch(url, params)
		.then((r) => r.text())
		.then((html) => {
			c('#busca-registro .resultado').innerHTML = html
		})
		.catch((erro) => {
			// erro em falhas
		})

	return false
}

function pesquisarForum() {
  	let pesquisa = c('.forum #posts form input#forum_posts').value
	let url = `${BASE}ajax/pesquisar_forum`
	let params = {
		method: 'POST',
		body: JSON.stringify({
			pesquisa: pesquisa
		})

	}
	fetch(url, params)
		.then((r) => r.text())
		.then((html) => {
			c('.forum #posts #posts-list').innerHTML = html
		})
		.catch((erro) => {
			// erro em falhas
		})

	return false
}

function buscarTopico(pesquisa) {
	let url = `${BASE}ajax/pesquisar_forum_cat`
	let params = {
		method: 'POST',
		body: JSON.stringify({
			pesquisa: pesquisa
		})

	}
	fetch(url, params)
		.then((r) => r.text())
		.then((html) => {
			c('.forum #posts #posts-list').innerHTML = html
			c('.categorias .categorias-body ul li.active').classList.remove('active')
			c(`.categorias .categorias-body ul li#${pesquisa}`).classList.add('active')
			c('.forum #posts-list').setAttribute('data-cat', pesquisa)
			c('.categorias-footer #pag-atual').innerHTML = 1
		})
		.catch((erro) => {
			// erro em falhas
		})
}

function moveBadge(num) {
    let valor = parseInt(c('.grupo-body #grupos a').style.marginLeft);
    valor = valor + (num)
    if(valor <= -1220) {
       valor = 0
    }
    if(valor <= 0) {
        c('.grupo-body #grupos a').style.marginLeft = `${valor}px`
    }
}

async function buscarBadge(id) {
	let url = `${BASE}ajax/buscar_badge`
	let params = {
		method: 'POST',
		body: JSON.stringify({
			id: id
		})

	}
	c('.grupos .grupo .grupo-footer').innerHTML = '';
	c('.grupos .grupo').style.height = '160px'
	c('.grupo-body #grupos a.active').classList.remove('active')
	c(`.grupo-body #grupos a:nth-child(${id})`).classList.add('active')
	await sleep(1000)
	fetch(url, params)
		.then((r) => r.text())
		.then((html) => {
			c('.grupos .grupo').style.height = '280px'
			c('.grupos .grupo .grupo-footer').innerHTML = html;
		})
		.catch((erro) => {
			// erro em falhas
		})
}

function citarComentario(obj) {
    let msg = c('.enviar-msg textarea#envie-msg').value;
    c('.enviar-msg textarea#envie-msg').value = obj.getAttribute('data-citacao') + '\n\n' + msg
}

function procurarPosicaoRanking() {
	let pesquisa = c('.ranking-geral .rg .minha-posicao #procurar_nickname').value
	let url = `${BASE}ajax/pesquisar_ranking`
	let params = {
		method: 'POST',
		body: JSON.stringify({
			pesquisa: pesquisa
		})

	}
	fetch(url, params)
		.then((r) => r.text())
		.then((html) => {
			c('.ranking-geral .rg #busca-posicao tbody').innerHTML = html
		})
		.catch((erro) => {
			// erro em falhas
		})

	return false
}

function copiarText() {
	/* Get the text field */
	var copyText = document.getElementById("codigo_confirmacao");

	/* Select the text field */
	copyText.select();
	copyText.setSelectionRange(0, 99999); /*For mobile devices*/

	/* Copy the text inside the text field */
	document.execCommand("copy");

	/* Alert the copied text */
	var elems = document.querySelector('.tooltipped');
	var instance = M.Tooltip.init(elems, []);
	c('#codigo-text-label').setAttribute('data-tooltip', 'Texto copiado com sucesso!')
	instance.open();
	// c('.material-tooltip .tooltip-content').innerHTML = 'Texto copiado com sucesso!'
}

let $rangeInput = c('.range input');
if($rangeInput) {
	var sheet = document.createElement('style'),
	prefs = ['webkit-slider-runnable-track', 'moz-range-track', 'ms-track'];
	document.body.appendChild(sheet);
	var getTrackStyle = function (el) {  
		var curVal = el.value,
		val = curVal,
		style = '';

		// Change background gradient
		for (var i = 0; i < prefs.length; i++) {
			style += '.range {background: linear-gradient(to right, #8000FE 0%, #4000FF ' + val + '%, #fff ' + val + '%, #fff 100%)}';
			style += '.range input::-' + prefs[i] + '{background: linear-gradient(to right, #8000FE 0%, #4000FF ' + val + '%, #b2b2b2 ' + val + '%, #b2b2b2 100%)}';
		}

		if(val >= 1) {
			c('.volume i').classList.add('fa-volume-up')
			c('.volume i').classList.remove('fa-volume-off')
		} else {
			c('.volume i').classList.add('fa-volume-off')
			c('.volume i').classList.remove('fa-volume-up')
		}	

		localStorage.volumeRadio = val
		Radio.volume(val / 100);

		return style;
	}	

	$rangeInput.addEventListener('input', function() {
		sheet.textContent = getTrackStyle(this);
	});
}

if ($radio) {
	if(localStorage.volumeRadio) {
		$rangeInput.value = localStorage.volumeRadio;
	} else {
		$rangeInput.value = 50
	}

	sheet.textContent = getTrackStyle($rangeInput);

	c('#radio-pesquisa .radio .botoes button:nth-child(1)').addEventListener('click', () => {
		if(localStorage.volumeRadio && localStorage.volumeRadio == "0") {
			$rangeInput.value = 30;
		}
		sheet.textContent = getTrackStyle($rangeInput);
	})
	c('#radio-pesquisa .radio .botoes button:nth-child(2)').addEventListener('click', () => {
		Radio.pause()
		$rangeInput.value = localStorage.volumeRadio;
		sheet.textContent = getTrackStyle($rangeInput);
	})
}

$(document).ready(function(){
	$('.tooltipped').tooltip();
	$('.data_nascimento').mask('00/00/0000');
});