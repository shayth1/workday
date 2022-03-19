<?php
require '../../assets/setup/db.inc.php';

$project_id = $_POST['project_id'];
$task_name = $_POST['task_name'];
$priority = $_POST['priority'];
$task_etime = $_POST['task_etime'];
$discription = $_POST['discription'];
$cdate = date("Y-m-d");
$status = "New";

$sql = "INSERT INTO task (task_project, task_name, task_cdate, task_estimated ,task_discription, priority, task_status)
         VALUES ('$project_id', '$task_name', '$cdate', '$task_etime', '$discription','$priority', '$status')";

$addStatus = mysqli_query($conn, $sql);

if ($addStatus) {
    header("Location: ../index.php?id=$project_id");
} else {
    header("Location: ../index.php?id=$project_id");
}