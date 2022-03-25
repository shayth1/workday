<?php

define('TITLE', "Home");
include '../assets/layouts/header.php';


?>


<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container">
    <div class="row">
        <?php
        $query = "SELECT * FROM users";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $query)) {
            die('ERROR IN CONNECTION');
        } else {
            mysqli_stmt_execute($stmt);
            $result1 = mysqli_stmt_get_result($stmt);
            while ($row = mysqli_fetch_assoc($result1)) {
                echo '
        <div class="col-md-4">
            <div class="card user-card">
                <div class="card-header">
                    <h5>Profile</h5>
                </div>
                <div class="card-block">
                    <div class="user-image">
                        <img src="../assets/uploads/users/' . $row['profile_image'] . '" class="img-radius"
                            alt="User-Profile-Image">
                    </div>
                    <h6 class="f-w-600 m-t-25 m-b-10">' . $row['first_name'] .  '' . $row['last_name'] . '</h6>
                   
                
                    <p class="m-t-15 text-muted">' . $row['bio'] . '</p>
                    <hr>
                    <div class="row justify-content-center user-social-link">
                        <div class="col-auto"><a href="callto:' . $row['headline'] . '"><i class="fa fa-phone text-facebook"></i></a></div>
                        <div class="col-auto"><a href="mailto:' . $row['email'] . '"><i class="fa fa-envelope-o text-twitter"></i></a></div>
                        <div class="col-auto"><a href="../user-profile/index.php?id=' . $row['id'] . '"><i class="fa fa-search-plus text-dribbble"></i></a></div>
                    </div>
                </div>
            </div>
        </div>';
            }
        }
        ?>




    </div>
</div>




<?php

include '../assets/layouts/footer.php'

?>