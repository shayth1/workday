<?php
require '../../assets/setup/db.inc.php';

$task_id = $_POST['task_id'];
$task_actual = $_POST['task_actual'];
$project_id = $_POST['project_id'];
echo $task_id, $user;
$sql = "UPDATE task SET task_actual= '$task_actual' WHERE task_id =$task_id";
echo $sql;
$assign = mysqli_query($conn, $sql);

if ($assign) {
    header("Location: ../task.php?tid=$task_id&pid=$project_id");
} else {
    header("Location: ../task.php?tid=$task_id&pid=$project_id");
}