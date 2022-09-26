<?php
ob_start();
?>
<section class="row p-2 mb-5">
    <div class="col-12">
        <div class="row text-center mb-3">
            <div class="col col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                <!-- déclenche modale avec form ajout de tache -->
                <p id="newTask"><i class="bi bi-plus-circle"></i> Nouvelle tâche</p>
                <form action="" method="post" class="mb-4 text-start d-none" id="newTaskForm">
                    <div class="mb-3">
                        <label for="taskname" class="form-label">Nom de la tâche</label>
                        <input type="text" class="form-control" id="taskname" name="taskname">
                        <div id="nameHelp" class="form-text d-none"></div>
                    </div>
                    <div class="mb-3">
                        <label for="comment" class="form-label">Commentaires</label>
                        <textarea name="comment" id="comment" rows="2" class="form-control"></textarea>
                        <div id="commentHelp" class="form-text d-none"></div>
                    </div>
                    <div class="mb-3 d-md-flex flex-column flex-md-row">
                        <div class="flex-grow-1 pe-md-2">
                            <label for="priority" class="form-label">Priorité</label>
                            <select class="form-select" id="priority">
                                <option value="low">Basse</option>
                                <option value="medium">Moyenne</option>
                                <option value="high">Haute</option>
                            </select>
                        </div>
                        <div class="flex-grow-1 ps-md-2">
                            <label for="date" class="form-label">Date butoir</label>
                            <input type="date" class="form-control" id="date" name="date">
                            <div id="dateHelp" class="form-text d-none"></div>
                        </div>

                    </div>
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-ming">Ajouter</button>
                    </div>
                </form>
            </div>
            <!-- fait apparaitre une sélection de filtres via toggle js -->
            <p id="filter"><i class="bi bi-filter"></i> Filtres</p>
        </div>
        <div id="taskList" class="row px-lg-5 px-3">
            <!-- boucle pour afficher toutes les tâches -->
            <div class="col-12 card p-0 mb-1 bg-isabelline border-0">
                <div class="card-body p-1 row">
                    <div class="col-12 col-md-auto d-flex mb-2 mb-md-0" >
                        <div class="rounded-circle py-1 px-2 mx-2 priority high"><i class="bi bi-exclamation-lg text-white"></i></div>
                        <div class="toDo px-2 text-center py-1 mx-2 text-white">TO DO</div>
                        <div class="rounded-pill py-1 px-3 mx-2 bg-white d-md-none">11/10/2022</div>
                        <button class="btn rounded-circle py-1 px-2 mx-2 bg-white d-md-none" title="lire les commentaires"><i class="bi bi-chat-text"></i></button>
                    </div>
                    <div class=" col-12 col-md mb-2 mb-md-0">
                        <div class="rounded-pill py-1 px-3 mx-2 bg-white">Ici, le nom d'une tâche à effectuer</div>
                    </div>
                    <div class="col-12 col-md-auto d-flex mb-2 mb-md-0 justify-content-end">
                        <div class=" rounded-pill py-1 px-3 mx-2 bg-white d-none d-md-block">11/10/2022</div>
                        <button class="btn rounded-circle py-1 px-2 mx-2 bg-white d-none d-md-block" title="lire les commentaires"><i class="bi bi-chat-text"></i></button>
                        <button class="btn rounded-circle py-1 px-2 mx-2 bg-primary" title="modifier"><i class="bi bi-pencil text-white"></i></button>
                        <button class="btn rounded-circle py-1 px-2 mx-2 bg-danger" title="supprimer"><i class="bi bi-x-lg text-white"></i></button>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</section>

<?php
$content = ob_get_clean();
$title = "TO DO LIST";
require('template.php');