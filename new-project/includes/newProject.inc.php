<?php
require '../../assets/setup/db.inc.php';

if (isset($_POST['cProject'])) {

    $project_edate = $_POST['project_edate'];
    $project_sdate = $_POST['project_sdate'];
    $project_owner = $_POST['project_owner'];
    $project_name = $_POST['project_name'];
    $project_status = "Active";

    echo  $project_edate,
    $project_sdate,
    $project_owner,
    $project_name,
    $project_status;



    /*
        * -------------------------------------------------------------------------------
        *   Image Upload
        * -------------------------------------------------------------------------------
        */

    $FileNameNew = 'project.png';
    $file = $_FILES['avatar'];

    if (!empty($_FILES['avatar']['name'])) {

        $fileName = $_FILES['avatar']['name'];
        $fileTmpName = $_FILES['avatar']['tmp_name'];
        $fileSize = $_FILES['avatar']['size'];
        $fileError = $_FILES['avatar']['error'];
        $fileType = $_FILES['avatar']['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png', 'gif');
        if (in_array($fileActualExt, $allowed)) {

            if ($fileError === 0) {

                if ($fileSize < 10000000) {

                    $FileNameNew = uniqid('', true) . "." . $fileActualExt;
                    $fileDestination = '../../assets/uploads/project/' . $FileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                } else {

                    $_SESSION['ERRORS']['imageerror'] = 'image size should be less than 10MB';
                    header("Location: ../");
                    exit();
                }
            } else {

                $_SESSION['ERRORS']['imageerror'] = 'image upload failed, try again';
                header("Location: ../");
                exit();
            }
        } else {

            $_SESSION['ERRORS']['imageerror'] = 'invalid image type, try again';
            header("Location: ../");
            exit();
        }
    }
    echo $FileNameNew;

    $sql = "INSERT INTO project (project_edate, project_sdate, project_owner, project_name, project_logo, project_status)
         VALUES ('$project_edate', '$project_sdate', '$project_owner', '$project_name', '$FileNameNew','$project_status')";

    $addProject = mysqli_query($conn, $sql);

    if ($addProject) {
        header("Location: ../../home");
    } else {
        header("Location: ../");
    }
} else {

    header("Location: ../");
    exit();
}