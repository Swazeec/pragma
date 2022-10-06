<?php
ob_start(); 

if(!empty($_SESSION['alert'])):
    ?>
    <div class="row d-flex justify-content-center alert alert-<?=$_SESSION['alert']['type'] ?> mt-0" role="alert">
        <?= $_SESSION['alert']['msg'] ?>
    </div>
    <?php
    unset($_SESSION['alert']);
    endif;
    ?>
<section class="row p-2 mb-5  mt-5">
    <form method="POST" class="col-12 col-md-6 offset-md-3 pt-5" action="<?=URL?>login/li">
    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" name="email">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <button type="submit" class="btn btn-ming">Se connecter</button>
    </form>

</section>

<?php
$content = ob_get_clean();
$title = "Pragma : identification";
require_once('views/template.php');