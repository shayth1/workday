<?php
require '../../assets/setup/db.inc.php';

$comment_user = $_POST['comment_user'];
$comment_task = $_POST['comment_task'];
$comment_project = $_POST['comment_project'];
$comment_text = $_POST['comment_text'];

$sql = "INSERT INTO comment (comment_user, comment_task, comment_text)
         VALUES ('$comment_user', '$comment_task', '$comment_text')";

$assign = mysqli_query($conn, $sql);

if ($assign) {
    header("Location: ../task.php?tid=$comment_task&pid=$comment_project");
} else {
    header("Location: ../task.php?tid=$comment_task&pid=$comment_project");
}