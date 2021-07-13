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