import{nameVerification, commentVerification,  priorityVerification, dateVerification, stateVerification} from './functions.js';

// bouton de soumission
let modifySubmitBtn = document.getElementById('modifySubmitBtn')

// champs à remplir
let modifytaskname = document.getElementById('modifytaskname')
let modifycomment = document.getElementById('modifycomment')
let modifyState = document.getElementById('modifyState')
let modifypriority = document.getElementById('modifypriority')
let modifydate = document.getElementById('modifydate')

// champs d'aide
let modifynameHelp = document.getElementById('modifynameHelp')
let modifycommentHelp = document.getElementById('modifycommentHelp')
let modifydateHelp = document.getElementById('modifydateHelp')
let modifyStateHelp = document.getElementById('modifyStateHelp')
let modifypriorityHelp = document.getElementById('modifypriorityHelp')


// vérifier à la soumission du formulaire
modifySubmitBtn.addEventListener('click', (e)=>{
    let error = 0
    if(!nameVerification(modifytaskname.value)){
        error = 1
        modifynameHelp.innerHTML = "Veuiller entrer le nom d'une tâche valide. 150 caractères max."
        modifynameHelp.classList.remove('d-none')
    } else {
        modifynameHelp.classList.add('d-none')
    }
    if(!commentVerification(modifycomment.value)){
        error = 1
        modifycommentHelp.innerHTML = "1000 caractères max. Vous avez "+ comment.value.length +" caractères."
        modifycommentHelp.classList.remove('d-none')
    } else {
        modifycommentHelp.classList.add('d-none')
    }
    if(!priorityVerification(modifypriority.value)){
        error = 1
        modifypriorityHelp.innerHTML = "Veuiller sélectionner une priorité valide"
        modifypriorityHelp.classList.remove('d-none')
    } else {
        modifypriorityHelp.classList.add('d-none')
    }
    if(!stateVerification(modifyState.value)){
        error = 1
        modifyStateHelp.innerHTML = "Veuiller sélectionner une priorité valide"
        modifyStateHelp.classList.remove('d-none')
    } else {
        modifyStateHelp.classList.add('d-none')
    }
    if(!dateVerification(modifydate.value)){
        error = 1
        modifydateHelp.innerHTML = "Veuiller sélectionner une date valide"
        modifydateHelp.classList.remove('d-none')
    } else {
        modifydateHelp.classList.add('d-none')
    }
    if(error === 1){
        e.preventDefault()
        error = 0
    }
})

