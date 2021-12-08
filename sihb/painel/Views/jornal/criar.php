<div class="card">
    <h5 class="card-header">Central de criação de notícia</h5>
    <div class="card-body">
        <form action="<?php echo BASE; ?>jornal/updateCriacao" method="POST" onchange="updateNoticia(this)" >

            <div class="form-group">
                <label for="titulo" class="col-form-label">Titulo da notícia</label>
                <input id="titulo" type="text" class="form-control" name="titulo" placeholder="Titulo da notícia..." value="<?php echo $noticia['titulo']; ?>" />
            </div>

            <div class="form-group">
                <label for="subtitulo" class="col-form-label">Subtitulo da notícia</label>
                <input id="subtitulo" type="text" class="form-control" name="subtitulo" placeholder="Subtitulo da notícia..." value="<?php echo $noticia['subtitulo']; ?>" />
            </div>

            <div class="form-group">
                <label for="banner" class="col-form-label">Banner da notícia</label>
                <input id="banner" type="text" class="form-control" name="banner" placeholder="Banner da notícia..." value="<?php echo $noticia['banner']; ?>" />
            </div>
        
            <div class="form-group">
                <label for="categoria">Categoria</label>
                <select class="form-control" id="categoria" name="categoria">
                    <option value="">Escolha uma categoria</option>
                    <?php foreach ($categorias as $categoria) : ?>
                        <option value="<?php echo $categoria['id']; ?>" <?php echo($noticia['categoria'] == $categoria['id'])?'selected':'';; ?>>
                            <?php echo $categoria['nome']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="texto">Texto:</label>
                <textarea name="texto" id="texto" class="texto"><?php echo $noticia['texto']; ?></textarea>
            </div>

            <input type="hidden" id="texto2" />       
            <input type="hidden" value="<?php echo $id; ?>" name="id" id="id" />
            <input type="hidden" value="2" name="tipo" id="tipo" />
            
            <button class="btn btn-outline-dark btn-block" onclick="unhook()" >Publicar</button>
        </form>
    </div>
</div>

<script src="https://cdn.tiny.cloud/1/wggjs4bncq8sk6p5rgbgk9bf31nvq758smbao3lv2kff4ds1/tinymce/5/tinymce.min.js"></script>
<script type="text/javascript">
    tinymce.init({
        selector: ".texto",
        height: 400,
        menubar: false,
        plugins: [
            'textcolor image media lists code link'
        ],
        toolbar: 'undo redo | formatselect fontselect | bold italic forecolor backcolor link | media image | alignleft aligncenter alignright alignjustify | bullist numlist | removeformat',
        init_instance_callback: function(editor) {
            editor.on('Change', function(e) {
                c('form #texto2').value = e.level.content
                updateNoticia(c('form'))
            });
        }
    });

    var hook = true;
    window.onbeforeunload = function(e) {
        if (hook) {
            e = e || window.event;

            // For IE and Firefox prior to version 4
            if (e) {
                e.returnValue = 'Sure?';
            }

            // For Safari
            return 'Sure?';        
        }
    }

    window.onunload = function() { return clearSession(); }
    
    function unhook() {
        hook=false;
    }

    if (hook == true) {
        let id = obj.querySelector('#id').value

        $.ajax({
            url:`${BASE}jornal/delete_my`,
            type:'POST',
            data:{
                id:27
            },
            success:function() {
            },
            error:function() {

            }
        });
    }
</script>