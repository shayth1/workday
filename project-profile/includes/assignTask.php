<?php
require '../../assets/setup/db.inc.php';

$task_id = $_POST['task_id'];
$user = $_POST['user'];
echo $task_id, $user;
$sql = "UPDATE task SET assign_to= '$user' WHERE task_id =$task_id";
echo $sql;
$assign = mysqli_query($conn, $sql);

if ($assign) {
    header("Location: ../");
} else {
    header("Location: ../");
}