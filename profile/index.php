<?php

define('TITLE', "Profile");
include '../assets/layouts/header.php';

?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" rel="stylesheet">
<div class="container">
    <div class="img" style="    background-image:  url(../assets/images/profile_banner.jpg);
    height: 350px;background-size: cover;"></div>
    <div class="card social-prof">
        <div class="card-body">
            <div class="wrapper">
                <img src="../assets/uploads/users/<?php echo $_SESSION['profile_image']; ?>" alt=""
                    class="user-profile">
                <h3><?php echo $_SESSION['first_name']; ?> <?php echo $_SESSION['last_name']; ?></h3>

            </div>
            <div class="row ">
                <div class="col-lg-12">
                    <ul class=" nav nav-tabs justify-content-center s-nav">

                        <li><a class="active" href="../profile-edit/index.php">Edit Profile</a></li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body info-card social-about">
                    <h2 class="text-blue">About <?php echo $_SESSION['first_name']; ?></h2>
                    <h4><strong>Skills</strong></h4>
                    <p><?php echo $_SESSION['bio']; ?></p>
                    <h4 class="mb-3"><strong>General Info</strong></h4>
                    <div class="row">
                        <div class="col-6">
                            <div class="social-info">
                                <i class="fas fa-check mr-2"></i>
                                <span>Last Login: <?php echo $_SESSION['last_login_at']; ?></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="social-info">
                                <i class="fa fa-venus-mars mr-2"></i>
                                <?php
                                if ($_SESSION['gender'] == "m") {
                                    $gender = "Male";
                                } else {
                                    $gender = "Female";
                                }
                                ?>
                                <span> <?php echo  $gender; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="social-info">
                                <i class="fas fas fa-users mr-2"></i>
                                <span>Member Since: <?php echo $_SESSION['created_at']; ?></span>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="social-info">
                                <i class="fas fas fa-mobile mr-2"></i>
                                <span><?php echo $_SESSION['headline']; ?></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="social-info">
                                <i class="fas fas fa-envelope mr-2"></i>
                                <span><?php echo $_SESSION['email']; ?></span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card info-card">
                <div class="card-body">
                    <h2 class="text-blue"> My Tasks</h2>
                    <table class="table project-table table-centered table-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Task Name</th>
                                <th scope="col">Priority</th>
                                <th scope="col">Status</th>
                                <th scope="col">Estimated effort</th>
                                <th scope="col">Created at</th>
                                <th scope="col">SHOW</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $query = "SELECT * FROM task WHERE assign_to = $_SESSION[id]";
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

                                        <a href="../project-profile/task.php?tid=' . $row['task_id'] . '&pid=' . $row['task_project'] . '" class="text-success " data-toggle="tooltip" data-placement="top"
                                            title="" data-original-title="Edit"> <i class="fa fa-eye h5 "></i></a>

                                    </td>
                                </tr>';
                                }
                            }
                            ?>
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>

</div>

<?php

include '../assets/layouts/footer.php'

?>