let tasks = [];


function addTask(){
    const newTask = document.getElementById('input_task').value;

    if(newTask){
        tasks.push(newTask);
        document.getElementById('input_task').value = ' ';
        displayTasks();
    }else{
        alert('Please Enter Your Task');
    }
}

function displayTasks(){
  const taskList = document.getElementById('taskList');
  taskList.innerHTML = ''; 
        tasks.forEach((task,index) => {
            const li = document.createElement('li');
            const span = document.createElement('span');
            span.id = `span_${index}`;
            span.textContent = task;
            const removeButton = document.createElement('button');
            removeButton.textContent = 'Remove';
            removeButton.onclick = () => removeTask(index);
            const completeTask = document.createElement('input');
            completeTask.type='checkbox';
            const editContent = document.createElement('input');
            editContent.type = 'text';
            editContent.id='new_input_task';
            editContent.value = task;
            const editButton = document.createElement('button');
            editButton.textContent = 'Edit';
            editButton.classList.add('edit-btn');   
            editButton.onclick = () => editTask(index);
            li.appendChild(span);
            li.appendChild(removeButton);
            li.appendChild(completeTask);
            li.appendChild(editContent);
            li.appendChild(editButton);
            taskList.appendChild(li);
        });
    
    
}


function removeTask(index)
{
    tasks.splice(index,1);
    displayTasks();
}

function editTask(index)
{
    const editTask = document.getElementById('new_input_task').value;
    if(editTask){
        tasks[index] = editTask;
        const spanContent = document.getElementById(`span_${index}`);
        spanContent.textContent = editTask;
    }else{
        alert('Please Enter Your Task');
    } 
}
