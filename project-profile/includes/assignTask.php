<?php
require '../../assets/setup/db.inc.php';
$project_id = $_POST['project_id'];
$task_id = $_POST['task_id'];
$user = $_POST['user'];
echo $task_id, $user;
$sql = "UPDATE task SET assign_to= '$user' WHERE task_id =$task_id";
echo $sql;
$assign = mysqli_query($conn, $sql);

if ($assign) {
    header("Location: ../task.php?tid=$task_id&pid=$project_id");
} else {
    header("Location: ../task.php?tid=$task_id&pid=$project_id");
}