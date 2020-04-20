<?php
/** FOLDER FUNCTION SECTION */

$currentUserId = getCurrentUserId();
function addFolder($folderName)
{
    global $db;
    global $currentUserId;
    $sql = "INSERT INTO folders (name, user_id) VALUES (?,?)";
    $stmt = $db->prepare($sql);
    $stmt->execute([$folderName, $currentUserId]);
}

function deleteFolder($folder_id)
{
    global $db;
    $query = "DELETE FROM folders WHERE id=$folder_id";
    $stmt = $db->prepare($query);
    $stmt->execute();
    return $stmt->rowCount();
}

function getFolders()
{
    global $db;
    global $currentUserId;
    $query = "SELECT * FROM folders WHERE user_id = $currentUserId";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $records;
}

/** TASKS FUNCTION SECTION */

function getTasks()
{

    $condition = '';
    if (isset($_GET['folder_id'])) {
        $folderId = $_GET['folder_id'];
        $condition = " and folder_id = $folderId";
    }
    global $db;
    global $currentUserId;
    $sql = "SELECT * FROM tasks WHERE user_id = $currentUserId $condition";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $records;
}

function getFolderTasks($folderId)
{
    global $db;
    $sql = "SELECT * FROM tasks WHERE folder_id = $folderId";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $records;
}

function addTask($title, $folder_id)
{
    global $db;
    global $currentUserId;
    $data = [
        'title' => $title,
        'user_id' =>$currentUserId,
        'folder_id' => $folder_id
    ];
    $sql = "INSERT INTO `tasks`(`title`, `user_id`, `folder_id`) VALUES (:title, :user_id, :folder_id)";
    $stmt = $db->prepare($sql);
    $stmt->execute($data);
    return $stmt->rowCount();
}

function deleteTask($taskId)
{
    global $db;
    $sql = "DELETE FROM tasks WHERE id = $taskId";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    return $stmt->rowCount();
}

function doneSwitch($taskId)
{
    global $db;
    global $currentUserId;
    $sql = "UPDATE tasks SET is_done = 1 - is_done WHERE user_id = :userId AND id= :taskId";
    $stmt = $db->prepare($sql);
    $stmt->execute(['userId' => $currentUserId, 'taskId' => $taskId]);
}
