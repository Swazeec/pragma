<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Pragma : la solution pour s'organiser et ne rien oublier !">
    <title>Pragma : To Do List</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@200;400&family=Gudea&family=Trirong:ital,wght@0,100;0,300;0,400;0,500;1,300;1,400;1,500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="<?=URL?>assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="<?=URL?>assets/images/Pragma-favicon.svg" type="image/x-icon">
</head>
<body>
    <main class="container-fluid ">
        <header class="row d-flex align-items-center px-2">
            <div class="col">
                <a href="index.html"><img id="logo" class="img-fluid" src="<?=URL?>assets/images/pragma-logo-transparent.svg" alt="Logo Pragma"></a>
            </div>
            <h1 class="col "><?= $title ?></h1>
        </header>
        <?= $content ?>
        <footer class="row fixed-bottom py-1 px-2">
            <div class="col text-center p-1 m-0">
                <a class="d-flex justify-content-center align-items-center" href="index.html"><img src="<?=URL?>assets/images/logo-footer.svg" alt="Logo Pragma" style="height: 15px;"></a>
            </div>
        </footer>
    </main>
    <script src="<?=URL?>assets/js/script.js"></script>
    <?php if(!empty($script)){
        echo $script;
    } ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>