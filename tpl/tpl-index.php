<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title><?= SITE_TITLE ?></title>
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/style.css">
</head>
<body>
<!-- partial:index.partial.html -->
<div id="msg">
    
</div>
<div class="page"> 
  <div class="pageHeader">
    
    <div class="title">Dashboard</div>
    <div class="userPanel"><a href="?action=sign-out"><i class="fa fa-sign-out"></a></i><span class="username"><?= $user[0]->name ?> </span><img src="<?= $grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $user[0]->email ) ) )
 ?>" width="40" height="40"/></div>
  </div>
  <div class="main">
    <div class="nav">
      <div class="searchbox">
        <div><i class="fa fa-search"></i>
          <input type="search" placeholder="Search"/>
        </div>
      </div>
<!-- start folders section -->
      <div class="menu">
        <div class="title">Folders</div>
        <ul id="folders">
        <a class="<?= (($_GET['folder_id'] === $folder->id) ? "active" : ""); ?>" href="<?= BASE_URL ?>"><li><i class="fa fa-folder" ></i>All</li></a>
          <!-- start php folders code section -->
          <?php foreach($folders as $folder): ?>
            <a class="<?= (($_GET['folder_id'] === $folder->id) ? "active" : ""); ?>" href="?folder_id=<?= $folder->id ?>&name=<?= $folder->name ?>"><li id="folder-name"><i class="fa fa-folder"></i><?= $folder->name?><a href="?delete_folder=<?= $folder->id ?>" onclick="return confirm('Are you sure delete this folder?');"><i class="fa fa-trash-o"></i></a></li></a>          
          <?php endforeach; ?>
          <!-- end php folders code section -->
        </ul>
        <div>
          <input id="add-new-folder" type="text" placeholder="Add New Folder" style="width: 60%"/>
          <button class="btn" id="add-folder-btn"><i class="fa fa-plus"></i></button>
        </div>
      </div>
<!-- end folder section -->
    </div>
    <div class="view">
      <div class="viewHeader">
        <div class="title" style="width: 25%;">
        <input style="width: 160%;" id="addNewTask" type="text" placeholder="Add New Task"/>
        </div>
        <div class="functions">
          <div class="button">Completed</div>
          <div class="button active">Add New Task</div>
        </div>
      </div>
<!-- start tasks Section -->
      <div class="content">
        <div class="list">       
          <div class="title" id="folder-title">Folder Name : <span class="folder-name"><?= (!isset($_GET['name'])) ? 'All': $folderName; ?></span></div>
          <div class="title">Today</div>
          <ul>
            <!-- start php tasks code section -->
            <?php if(sizeof($tasks)): ?>
          <?php foreach($tasks as $task): ?>          
            <li class="<?= ($task->is_done ? 'checked' : ''); ?>"><i id="done" data-taskId= <?= $task->id ?> class="clickable fa fa-<?= ($task->is_done ? 'check-square-o' : 'square-o'); ?>"></i><span><?= $task->title ?></span>
              <div class="info">
                <span id="created-at">Created at <?= $task->created_at ?></span><a href="?delete_task=<?= $task->id ?>" onclick="return confirm('Are you sure delete this item?');"><i class="fa fa-trash-o"></i></a>
              </div>
            </li>
          <?php endforeach; ?>
          <?php else: ?>
            <li>
              No Task
            </li>
          <?php endif; ?>
          
            <!-- end php tasks code section -->
          </ul>
        </div>
      </div>
<!-- end tasks section -->
    </div>
  </div>
</div>
<!-- partial -->
<!-- javascript -->
  <script  src="<?= BASE_URL ?>assets/js/script.js"></script>
  <script>
    newTaskInput.addEventListener('keyup', event => {
      taskAdd(event);
    });
    function taskAdd(event) {
      if (event.which == 13 || event.keyCode == 13) {
        let inputValue = newTaskInput.value;
        let data = {
          action: 'addTask',
          taskTitle: inputValue,
          folderId: <?= $_GET['folder_id'] ?? "null" ?>
        }
        addTaskAjax(data);
      };     
    }
  </script>
  
</body>
</html>
