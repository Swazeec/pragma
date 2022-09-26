let newTaskBtn = document.getElementById('newTask')
let newTaskForm = document.getElementById('newTaskForm')

newTaskBtn.addEventListener('click', ()=>{
    newTaskForm.classList.toggle('d-none')
})