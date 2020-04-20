/** JAVA SCRIPT ALL CODE */

const addFolderInput = document.getElementById('add-new-folder');
const addFolderBtn = document.getElementById('add-folder-btn');
const msg = document.getElementById('msg');
const foldersList = document.getElementById('folders');
const newTaskInput = document.getElementById('addNewTask');
const doneElement = document.querySelectorAll('#done');
// event listener
addFolderBtn.addEventListener('click', ajax);
doneElement.forEach((value) => {
  value.addEventListener('click', event => {
    let element = event.target;
    element.addEventListener('click', doneSwitch(element));
  })
})

  
// functions
function ajax() {
  let inputValue = addFolderInput.value;
  let data = {
    action: 'addFolder',
    folderName: inputValue
  }

  let formData = new FormData(); 
  for (let key in data) {
    formData.append(key,data[key])
  };

  fetch('process/ajax-handler.php',{
    method: 'POST',
    body: formData
  })
  .then(response => response.text())
  .then(data =>  displayResult(data))
  .catch((error) => console.log("Error: " + error));
};

function displayResult(data) {
  if(data.indexOf('error') > -1) {
    msg.innerHTML = data
    setTimeout(() => {
      msg.firstElementChild.remove();        
    }, 2000);
  } else {
  window.location.reload()
  }
}

function addTaskAjax(data) {
  let formData = new FormData(); 
  for (let key in data) {
    formData.append(key,data[key])
  };
  fetch('process/ajax-handler.php',{
    method: 'POST',
    body: formData
  })
  .then(response => response.text())
  .then(data => displayResult(data))
  .catch((error) => console.log("Error: " + error));
}

function doneSwitch(element) {
  let formData = new FormData(); 
  formData.append("taskId", element.getAttribute('data-taskId'));
  formData.append("action", "done");
  fetch('process/ajax-handler.php',{
      method: 'POST',
      body: formData
  })
  .then(response => response.text())
  .then(data => displayResult(data))
  .catch((error) => console.log("Error: " + error));
}

newTaskInput.focus();




