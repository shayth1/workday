<?php
define('TITLE', "Project");
include '../assets/layouts/header.php';
if (isset($_GET['id'])) {
    $projectid = $_GET['id'];
} else {
    header("Location:../home");
}
$sql = "SELECT * FROM project WHERE project_id ='$projectid'";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    die('SQL ERROR');
} else {
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $project = mysqli_fetch_assoc($result);
}
?>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

<div class="container">
    <div class="row">
        <div class="col-xl-4 col-md-6">
            <div class="card bg-pattern">
                <div class="card-body">
                    <div class="float-right">
                        <i class="fa fa-archive text-primary h4 ml-3"></i>
                    </div>
                    <h5 class="font-size-20 mt-0 pt-1"><?php echo $project['project_name']; ?>

                        <p class="text-muted mb-0"><?php echo $project['project_status']; ?></p>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card bg-pattern">
                <div class="card-body">
                    <div class="float-right">
                        <button data-toggle="modal" data-target="#exampleModal" class="btn btn-success" type="button"><i
                                class="fa fa-plus"></i></button>
                    </div>

                    <h5 class="font-size-20 mt-0 pt-1">New
                        <p class="text-muted mb-0">Create new task</p>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card bg-pattern">
                <div class="card-body">
                    <div class="float-right">
                        <i class="fa fa-file text-primary h4 ml-3"></i>
                    </div>
                    <h5 class="font-size-20 mt-0 pt-1">

                        <?php
                        $query1 = mysqli_query($conn, "SELECT count(*) AS 'countT' FROM task WHERE task_project = $project[project_id];");
                        $row = mysqli_fetch_array($query1);
                        $count_S = $row['countT'];
                        echo $row["countT"]; ?>

                    </h5>
                    <p class="text-muted mb-0">Tasks</p>
                </div>
            </div>
        </div>

    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive project-list">
                        <table class="table project-table table-centered table-nowrap">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Task Name</th>
                                    <th scope="col">Priority</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Estimated effort</th>
                                    <th scope="col">Created at</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $query = "SELECT * FROM task WHERE task_project = $projectid";
                                $stmt = mysqli_stmt_init($conn);
                                if (!mysqli_stmt_prepare($stmt, $query)) {
                                    die('ERROR IN CONNECTION');
                                } else {
                                    mysqli_stmt_execute($stmt);
                                    $result = mysqli_stmt_get_result($stmt);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '
                                <tr>
                                    <th scope="row">' . $row['task_id'] . '</th>
                                    <td>' . $row['task_name'] . '</td>
                                    <td>' . $row['priority'] . '</td>
                                    <td>
                                        <span class="text-secoundary font-12">' . $row['task_status'] . '</span>
                                    </td>
                                    <td>
                                    <span class="text-secoundary font-12"> ' . $row['task_estimated'] . ' hr</span>
                                   
                                    </td>
                                    <td>
                                    ' . $row['task_cdate'] . '
                                    </td>

                                    <td>

                                        <a href="task.php?tid=' . $row['task_id'] . '&pid=' . $row['task_project'] . '" class="text-success " data-toggle="tooltip" data-placement="top"
                                            title="" data-original-title="Edit"> <i class="fa fa-eye h5 "></i></a>

                                    </td>
                                </tr>';
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- end project-list -->


                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="includes/addTask.php" method="POST">
                    <div class="form-group">
                        <label for="task_name" class="col-form-label">Task Name: </label>
                        <input style="display: none;" type="text" value="<?php echo $project['project_id']; ?>"
                            name="project_id">
                        <input type="text" class="form-control" name="task_name">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Priority</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="priority">
                            <option value="Urgent">Urgent</option>
                            <option value="High">High</option>
                            <option value="Medium">Medium</option>
                            <option value="Low">Low</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="task_etime" class="col-form-label">Due Date:</label>
                        <input type="date" class="form-control" name="task_due">
                    </div>
                    <div class="form-group">
                        <label for="task_etime" class="col-form-label">Estimated Effort (Hours):</label>
                        <input type="text" class="form-control" name="task_etime">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Discription:</label>
                        <textarea class="form-control" name="discription"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Add task</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<?php

include '../assets/layouts/footer.php'

?>