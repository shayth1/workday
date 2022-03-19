<?php

define('TITLE', "Home");
include '../assets/layouts/header.php';
check_verified();

?>


<main role="main" class="container">

    <div class="row">
        <div class="col-sm-3">

            <?php include('../assets/layouts/profile-card.php'); ?>

        </div>
        <div class="col-sm-9">

            <div class="d-flex align-items-center p-3 mt-5 mb-3 text-white-50 bg-purple rounded box-shadow">
                <img class="mr-3" src="../assets/images/logonotextwhite.png" alt="" width="48" height="48">
                <div class="lh-100">
                    <h6 class="mb-0 text-white lh-100">Hey there, <?php echo $_SESSION['username']; ?></h6>
                    <small>Last logged in at <?php echo date("m-d-Y", strtotime($_SESSION['last_login_at'])); ?></small>
                </div>
            </div>

            <div class="my-3 p-3 bg-white rounded box-shadow">
                <h6 class="mb-0">My Project's</h6>
                <sub class="text-muted border-bottom border-gray pb-2 mb-0">[Projects created by
                    <?php echo $_SESSION['username']; ?>]</sub>

                <table class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $owner = $_SESSION['id'];
                        $query = "SELECT * FROM project WHERE project_owner = '$owner'";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $query)) {
                            die('ERROR IN CONNECTION');
                        } else {
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '
                        <tr>
                            <td><a href="../project-profile/index.php?id=' . $row['project_id'] . '"><img src="../assets/uploads/project/' . $row['project_logo'] . '" width="32" height="32"
                            class="rounded-circle my-n1" alt="Avatar"></a></td>
                            <td>' . $row['project_name'] . '</td>
                            <td>' . $row['project_sdate'] . '</td>
                            <td>' . $row['project_edate'] . '</td>
                            <td>' . $row['project_status'] . '</td>
                        </tr>';
                            }
                        }


                        ?>
                    </tbody>
                </table>

                <small class="d-block text-right mt-3">
                    <a class="btn btn-primary" href="../new-project">New Project</a>
                </small>
            </div>

        </div>
    </div>
</main>




<?php

include '../assets/layouts/footer.php'

?>