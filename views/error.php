<?php
ob_start();
echo $msg;
$content = ob_get_clean();
$title = "Pragma : pour ne rien oublier !";
require('views/template.php');