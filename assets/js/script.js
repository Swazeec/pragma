// affichage formulaire ajout

let newTaskBtn = document.getElementById('newTask')
let newTaskForm = document.getElementById('newTaskForm')

newTaskBtn.addEventListener('click', ()=>{
    newTaskForm.classList.toggle('d-none')
})

// gestion des états
let toDos = [...document.getElementsByClassName('state-1')]
let doings = [...document.getElementsByClassName('state-2')]
let dones = [...document.getElementsByClassName('state-3')]

toDos.forEach(element => {
    element.innerHTML = "TO DO"
})
doings.forEach(element => {
    element.innerHTML = "DOING"
})
dones.forEach(element => {
    element.innerHTML = "DONE"
})