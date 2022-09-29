import{nameVerification, commentVerification,  priorityVerification, dateVerification} from './functions.js';

// bouton de soumission
let submitBtn = document.getElementById('submitBtn')

// champs à remplir
let taskname = document.getElementById('taskname')
let comment = document.getElementById('comment')
let priority = document.getElementById('priority')
let date = document.getElementById('date')

// champs d'aide
let nameHelp = document.getElementById('nameHelp')
let commentHelp = document.getElementById('commentHelp')
let dateHelp = document.getElementById('dateHelp')
let priorityHelp = document.getElementById('priorityHelp')


// vérifier à la soumission du formulaire
submitBtn.addEventListener('click', (e)=>{
    let error = 0
    if(!nameVerification(taskname.value)){
        error = 1
        nameHelp.innerHTML = "Veuiller entrer le nom d'une tâche valide. 150 caractères max."
        nameHelp.classList.remove('d-none')
    } else {
        nameHelp.classList.add('d-none')
    }
    if(!commentVerification(comment.value)){
        error = 1
        commentHelp.innerHTML = "1000 caractères max. Vous avez "+ comment.value.length +" caractères."
        commentHelp.classList.remove('d-none')
    } else {
        commentHelp.classList.add('d-none')
    }
    if(!priorityVerification(priority.value)){
        error = 1
        priorityHelp.innerHTML = "Veuiller sélectionner une priorité valide"
        priorityHelp.classList.remove('d-none')
    } else {
        priorityHelp.classList.add('d-none')
    }
    if(!dateVerification(date.value)){
        error = 1
        dateHelp.innerHTML = "Veuiller sélectionner une date valide"
        dateHelp.classList.remove('d-none')
    } else {
        dateHelp.classList.add('d-none')
    }
    if(error === 1){
        e.preventDefault()
        error = 0
    }
})