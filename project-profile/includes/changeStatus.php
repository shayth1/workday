<?php
require '../../assets/setup/db.inc.php';

$task_id = $_POST['task_id'];
$status = $_POST['status'];
$project_id = $_POST['project_id'];

$sql = "UPDATE task SET task_status= '$status' WHERE task_id =$task_id";

$assign = mysqli_query($conn, $sql);

if ($assign) {
    header("Location: ../task.php?tid=$task_id&pid=$project_id");
} else {
    header("Location: ../task.php?tid=$task_id&pid=$project_id");
}