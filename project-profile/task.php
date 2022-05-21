<?php
// hide all notice and errors
// error_reporting(E_ALL ^ E_NOTICE);
define('TITLE', "Task");
include '../assets/layouts/header.php';
// get parameters from URL
if (isset($_GET['tid'])) {
    $taskid = $_GET['tid'];
    $projectid = $_GET['pid'];
} else {
    header("Location:../");
}
// Add a SQL query to get task based in task id that we got from URL
$sql = "SELECT * FROM task WHERE task_id = '$taskid'";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    die('SQL ERROR');
} else {
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $task = mysqli_fetch_assoc($result);
}
// Add a SQL query to get task based in task id that we got from URL
$sql2 = "SELECT * FROM project WHERE project_id = '$projectid'";
$stmt2 = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt2, $sql2)) {
    die('SQL ERROR');
} else {
    mysqli_stmt_execute($stmt2);
    $result2 = mysqli_stmt_get_result($stmt2);
    $project = mysqli_fetch_assoc($result2);
}
// display (CSS) controls for assign to based on project owner
if ($project['project_owner'] === $_SESSION['id']) {
    $display = "block";
} else {
    $display = "none";
}
// display (CSS) controls for Task status based on task owner
if ($task['assign_to'] === $_SESSION['id']) {
    $display2 = "block";
} else {
    $display2 = "none";
}
// get users as a list from DB
$user = "SELECT * FROM users";
$getUser = mysqli_query($conn, $user);

$developer = $task['assign_to'];

if ($task['assign_to'] == $_SESSION['id'] && $task['task_estimated'] == 0) {
    $link = "http://localhost/workday/project-profile/taskEst.php?tid=$taskid";
    echo '<script>window.location.replace("' . $link . '");</script>';
}

?>

<!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"> -->
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="card-box task-detail">
                    <div class="media mt-0 m-b-30"><img class="d-flex mr-3 rounded-circle" alt="64x64"
                            src="../assets/uploads/project/<?php echo $project['project_logo']; ?>"
                            style="width: 48px; height: 48px;">
                        <div class="media-body">
                            <h5 class="media-heading mb-0 mt-0"><?php echo $task['task_name']; ?></h5><span
                                class="badge badge-danger"><?php echo $task['priority']; ?></span>
                        </div>
                    </div>

                    <p class="text-muted"><?php echo $task['task_discription']; ?></p>

                    <ul class="list-inline task-dates m-b-0 mt-5">
                        <li>
                            <h5 class="m-b-5">Creation Date</h5>
                            <p><?php echo $task['task_cdate']; ?></p>
                        </li>
                        <li>
                            <h5 class="m-b-5">Due Date</h5>
                            <p><?php echo $task['task_due']; ?> </p>
                        </li>
                    </ul>
                    <br>
                    <ul class="list-inline task-dates m-b-0 mt-5">
                        <li>
                            <h5 class="m-b-5">Estimated Effort (Hours)</h5>
                            <p><?php echo $task['task_estimated']; ?></p>
                        </li>
                        <li>
                            <h5 class="m-b-5">Actual Effort (Hours)</h5>
                            <p><?php echo $task['task_actual']; ?> </p>
                        </li>
                    </ul>
                    <br>
                    <ul class="list-inline task-dates m-b-0 mt-5">

                        <li>
                            <h5 class="m-b-5">Status</h5>
                            <p><?php echo $task['task_status']; ?> </p>
                        </li>
                    </ul>
                    <div class="clearfix"></div>

                    <div class="assign-team mt-4">
                        <h5 class="m-b-5">Assigned to</h5>
                        <div>

                            <?php
                            // Get developer name and profile picture

                            $query = "SELECT * FROM users WHERE id = '$developer'";
                            $stmt = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt, $query)) {
                                die('ERROR IN CONNECTION');
                            } else {
                                mysqli_stmt_execute($stmt);
                                $result1 = mysqli_stmt_get_result($stmt);
                                while ($row = mysqli_fetch_assoc($result1)) {
                                    echo '<a href="../user-profile/index.php?id=' . $row['id'] . '"><img class="rounded-circle thumb-sm"
                                src="../assets/uploads/users/' . $row['profile_image'] . '"> ' . $row['first_name'] . ' ' . $row['last_name'] . '</a>';
                                }
                            }
                            ?>


                        </div>
                    </div>

                </div>
            </div>
            <!-- end col -->



            <div class="col-md-4">
                <div class="card-box" style="display: <?php echo $display; ?>">
                    <h4 class="header-title m-b-30">Assign to</h4>
                    <div>
                        <div>
                            <form action="includes/assignTask.php" method="POST">
                                <div class="media-body col-md-12">
                                    <label for="subject">Select User</label>
                                    <select id="subject" name="user" class="form-control" required>
                                        </option>
                                        <?php while ($row = mysqli_fetch_array($getUser)) : ?>
                                        <option value="
                                    <?php echo $row[0];
                                    ?>">
                                            <?php echo $row[4];
                                                echo " ";
                                                echo $row[5]; ?>
                                        </option>
                                        <?php endwhile; ?>
                                    </select>
                                    <input style="display: none;" type="text" name="task_id"
                                        value="<?php echo $task['task_id']; ?>">
                                    <input style="display: none;" type="text" name="project_id"
                                        value="<?php echo $project['project_id']; ?>">
                                </div>
                                <div class="text-right mt-4">
                                    <button type="submit" class="btn btn-success waves-effect waves-light">Save</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-box" style="display: <?php echo $display2; ?>;">
                    <h4 class="header-title m-b-30">Status</h4>
                    <div>
                        <div class="">
                            <form action="includes/changeStatus.php" method="POST" class="row-md-12">
                                <div class="media-body">
                                    <label for="subject"><?php echo $task['task_status']; ?></label>
                                    <select name="status" class="form-control" required>
                                        <option value="on-Hold">on-Hold</option>
                                        <option value="in-Progress">in-Progress</option>
                                        <option value="Testing">Testing</option>
                                        <option value="Test Fail">Test Fail</option>
                                        <option value="Completed">Completed</option>
                                    </select>
                                    <input style="display: none;" type="text" name="task_id"
                                        value="<?php echo $task['task_id']; ?>">
                                </div>

                                <input style="display: none;" type="text" name="project_id"
                                    value="<?php echo $project['project_id']; ?>">
                                <div class="text-right mt-4">
                                    <button type="submit" class="btn btn-primary  waves-light">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card-box" style="display: <?php echo $display2; ?>;">
                    <h4 class="header-title m-b-30"></h4>
                    <div>
                        <div class="">
                            <form action="includes/changeActualEffort.php" method="POST" class="row-md-12">
                                <div class="media-body">
                                    <label for="subject">Actual Effort</label>
                                    <input type="number" class="form-control" name="task_actual"
                                        value="<?php echo $task['task_actual']; ?>">
                                    <input style="display: none;" type="text" name="task_id"
                                        value="<?php echo $task['task_id']; ?>">
                                </div>

                                <input style="display: none;" type="text" name="project_id"
                                    value="<?php echo $project['project_id']; ?>">
                                <div class="text-right mt-4">
                                    <button type="submit" class="btn btn-primary  waves-light">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- end col -->


            <!-- end col -->
            <div class="col-md-8">
                <div class="card-box">
                    <h4 class="header-title m-b-30">Comments</h4>
                    <div>
                        <?php
                        $query = "SELECT c.comment_task, c.comment_text, c.comment_user, u.first_name, u.last_name, u.profile_image, u.id 
                        FROM comment c INNER JOIN users u ON c.comment_user = u.id AND c.comment_task =  $task[task_id]";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $query)) {
                            die('ERROR IN CONNECTION');
                        } else {
                            mysqli_stmt_execute($stmt);
                            $result1 = mysqli_stmt_get_result($stmt);
                            while ($row = mysqli_fetch_assoc($result1)) {
                                echo '
                                <div class="media m-b-20">
                            <div class="d-flex mr-3">
                                <a href="../user-profile/index.php?id=' . $row['id'] . '"><img class="media-object rounded-circle thumb-sm" alt="64x64"
                                        src="../assets/uploads/users/' . $row['profile_image'] . '"></a>
                            </div>
                            <div class="media-body">
                                <h5 class="mt-0">' . $row['first_name'] .  ' ' . $row['last_name'] . '</h5>
                                <p class="font-13 text-muted mb-0"> ' . $row['comment_text'] . '</p>
                            </div>
                        </div>
                        <br>
                              

                                ';
                            }
                        }
                        ?>

                        <div class="media m-b-20">
                            <div class="d-flex mr-3">
                                <a href="#"><img class="media-object rounded-circle thumb-sm" alt="64x64"
                                        src="../assets/uploads/users/<?php echo $_SESSION['profile_image']; ?>"></a>
                            </div>
                            <div class="media-body">
                                <form action="includes/addComment.php" method="POST">
                                    <input type="text" name="comment_text" class="form-control input-sm"
                                        placeholder="Enter your comment...">
                                    <input style="display: none;" type="text" name="comment_user"
                                        value="<?php echo $_SESSION['id']; ?>">
                                    <input style="display: none;" type="text" name="comment_task"
                                        value="<?php echo $task['task_id']; ?>">
                                    <input style="display: none;" type="text" name="comment_project"
                                        value="<?php echo $project['project_id']; ?>">
                                    <div class="mt-2 text-right">
                                        <button type="submit"
                                            class="btn btn-sm btn-custom waves-effect waves-light">Post</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- container -->
</div>