
<section class="col-12" style="grid-column: 1 / 13; grid-row: 2;">

    <p id="modalButtonAddCategoryArticle" class="actionVerticalSection"><img src=<?php App\Core\View::getAssets("icons/plus-solid.svg")?> alt="" height="15" width="15">Créer une nouvelle catégorie</p>
</section>
<script src='https://cdn.tiny.cloud/1/sfgeuuulhp5vmw2y9c0fo94ydvh7zpah75c6trahqaw5g1y7/tinymce/5/tinymce.min.js' referrerpolicy="origin"></script>
<script src=<?php App\Core\View::getAssets("TinyMCE/fr_FR.js")?>></script>
<script src=<?php App\Core\View::getAssets("TinyMCE/tinymce_editor.js")?>></script>

<section class="col-12" style="grid-column: 1 / 13; grid-row: 1;">
    <?php if(!empty($formErrors)){?>
    <?php foreach($formErrors as $error):?>
            <div class="error"><?= $error ;?></div>

        <?php endforeach;?>
    <?php } else { //?>

    <?php } ?>
        <?php  App\Core\Form::showForm($form); ?>
</section>




<div id="ModalCategoryAddArticle" class="col-12 modal">
    <!-- Modal content -->
    <div class="modal-comment d-flex-wrap d-flex">
        <div class="headerForModalDesc d-flex">
            <h1 class="titleModal d-flex">Ajout d'une catégorie</h1>
            <span class="closeComment d-flex">&times;</span>
        </div>
        <?php  App\Core\Form::showForm($formCategory); ?>
    </div>
</div>



<script src=<?php App\Core\View::getAssets("modal.js")?>></script>
<script src=<?php App\Core\View::getAssets("popups.js")?>></script>
<script>
    $("#title").keyup(function(){
        update();
    });
    function update() {
        let value = $('#title').val().replace(/[^a-z0-9\w\d]+/g, "-");
        $("#uri").val(value.toLowerCase());
    }
</script>