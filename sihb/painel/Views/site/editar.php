<div class="card">
    <h5 class="card-header">Páginas do site</h5>
    <div class="card-body">
        <form action="<?php echo BASE; ?>site/editarTexto/<?php echo $pagina['id']; ?>" method="POST">
            <p>
                <strong>Página: </strong> <a href="<?php echo BASE_PAI . $pagina['local']; ?>" target="_blank" ><?php echo BASE_PAI . $pagina['local']; ?></a>
            </p>
            <div class="form-group mt-10">
                <label for="texto">Texto:</label>
                <textarea name="texto" id="texto" class="texto"><?php echo $pagina['texto']; ?></textarea>
            </div>

            <button class="btn btn-outline-dark btn-block">ATUALIZAR</button>
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
        toolbar: 'undo redo | formatselect fontselect fontsizeselect | bold italic forecolor backcolor link | media image | alignleft aligncenter alignright alignjustify | bullist numlist | code removeformat',
        fontsize_formats: '11px 12px 14px 16px 18px 24px 36px 48px',
        icons: 'material'
    });
</script>