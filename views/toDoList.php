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
<section class="row p-2 mb-5  mt-3">
    <div class="col-12">
        <div class="row text-center mb-3">
            <div class="col col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                <!-- déclenche modale avec form ajout de tache -->
                <p id="newTask"><i class="bi bi-plus-circle"></i> Nouvelle tâche</p>
                <form action="<?=URL?>toDoList/a" method="post" class="mb-4 text-start d-none" id="newTaskForm">
                    <div class="mb-3">
                        <label for="taskname" class="form-label">Nom de la tâche</label>
                        <input type="text" class="form-control" id="taskname" name="taskname">
                        <div id="nameHelp" class="form-text d-none text-danger"></div>
                    </div>
                    <div class="mb-3">
                        <label for="comment" class="form-label">Commentaires</label>
                        <textarea name="comment" id="comment" rows="2" class="form-control"></textarea>
                        <div id="commentHelp" class="form-text d-none text-danger"></div>
                    </div>
                    <div class="mb-3 d-md-flex flex-column flex-md-row">
                        <div class="flex-grow-1 pe-md-2">
                            <label for="priority" class="form-label">Priorité</label>
                            <select class="form-select" id="priority" name="priority">
                                <option value="1">Basse</option>
                                <option value="2">Moyenne</option>
                                <option value="3">Haute</option>
                            </select>
                            <div id="priorityHelp" class="form-text d-none text-danger"></div>
                        </div>
                        <div class="flex-grow-1 ps-md-2">
                            <label for="date" class="form-label">Date butoir</label>
                            <input type="date" class="form-control" id="date" name="date">
                            <div id="dateHelp" class="form-text d-none text-danger"></div>
                        </div>

                    </div>
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-ming" id="submitBtn">Ajouter</button>
                    </div>
                </form>
            </div>
            <!-- fait apparaitre une sélection de filtres via toggle js -->
            <p id="filter"><i class="bi bi-filter"></i> Filtres</p>
        </div>
        <div id="taskList" class="row px-lg-5 px-3">
            <!-- boucle pour afficher toutes les tâches -->
            <?php 
            for($i=0; $i<count($tasks); $i++) : ?>
            <div class="col-12 card p-0 mb-1 bg-isabelline border-0">
                <div class="card-body p-1 row">
                    <div class="col-12 col-md-auto d-flex mb-2 mb-md-0" >
                        <div class="rounded-circle py-1 px-2 mx-2 priority-<?=  $tasks[$i]->getPriority() ?>"><i class="bi bi-exclamation-lg text-white"></i></div>
                        <div class="px-2 text-center py-1 mx-2 text-white state state-<?=  $tasks[$i]->getState() ?>"></div>
                        <div class="rounded-pill py-1 px-3 mx-2 bg-white text-center d-md-none date"><?php 
                        if($tasks[$i]->getDueDate()){ echo $tasks[$i]->getDueDate(); } else { echo "/" ; };
                         ?></div>
                        <button type="button" class="btn rounded-circle py-1 px-2 mx-2 bg-white d-none d-sm-block d-md-none" data-bs-toggle="modal" data-bs-target="#task<?=  $tasks[$i]->getId() ?>" title="lire les commentaires"><i class="bi bi-chat-text"></i></button>
                    </div>
                    <div class=" col-12 col-md mb-2 mb-md-0">
                        <div class="rounded-pill py-1 px-3 mx-2 bg-white"><?=  $tasks[$i]->getName() ?></div>
                    </div>
                    <div class="col-12 col-md-auto d-flex mb-2 mb-md-0 justify-content-end">
                        <div class=" rounded-pill py-1 px-3 mx-2 bg-white text-center d-none d-md-block date"><?php 
                        if($tasks[$i]->getDueDate()){ echo $tasks[$i]->getDueDate(); } else { echo "/" ; };
                         ?></div>
                        <button type="button" class="btn rounded-circle py-1 px-2 mx-2 bg-white d-sm-none d-md-block" data-bs-toggle="modal" data-bs-target="#task<?=  $tasks[$i]->getId() ?>" title="lire les commentaires"><i class="bi bi-chat-text"></i></button>
                        <button class="btn rounded-circle py-1 px-2 mx-2 bg-primary" title="modifier"><i class="bi bi-pencil text-white"></i></button>
                        <form action="<?= URL ?>toDoList/s/<?= $tasks[$i]->getId() ?>" method="post">
                            <button class="btn rounded-circle py-1 px-2 mx-2 bg-danger" title="supprimer"><i class="bi bi-x-lg text-white"></i></button>
                        </form>
                    </div>
                </div>
            </div>  
            <!-- comments modal -->
            <div class="modal fade" id="task<?=  $tasks[$i]->getId() ?>" tabindex="-1" aria-labelledby="comments" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-body d-flex flex-column text-center">
                            <?php 
                                if($tasks[$i]->getComments()){
                                    echo $tasks[$i]->getComments() ;
                                } else {?>
                                    Pas de commentaire pour le moment...
                                <?php } ?>
                            
                            
                            <button type="button" class="btn btn-ming mt-5 mx-5" data-bs-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>

            <?php endfor ; ?>
        </div>
    </div>
</section>

<?php
$content = ob_get_clean();
$title = "TO DO LIST";
$script = '<script type="module" src="assets/js/addTaskVerifications.js"></script>';
require('template.php');