<?php

define('TITLE', "New Project");
include '../assets/layouts/header.php';

?>


<div class="container">
    <div class="row">
        <div class="col-md-4">

        </div>
        <div class="col-lg-4">

            <form class="form-auth" action="includes/newProject.inc.php" method="post" enctype="multipart/form-data">



                <div class="picCard text-center">
                    <div class="avatar-upload">
                        <div class="avatar-preview text-center">
                            <div id="imagePreview"
                                style="background-image: url( ../assets/uploads/project/project.png );"></div>
                        </div>
                        <div class="avatar-edit">
                            <input name='avatar' id="avatar" class="fas fa-pencil" type='file' />
                            <label for="avatar"></label>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <sub class="text-danger">
                        <?php
                        if (isset($_SESSION['ERRORS']['imageerror']))
                            echo $_SESSION['ERRORS']['imageerror'];

                        ?>
                    </sub>
                </div>

                <h6 class="h3 mt-3 mb-3 font-weight-normal text-muted text-center">Create New Project</h6>



                <div class="form-group">

                    <input type="text" id="username" name="project_name" class="form-control" placeholder="Project Name"
                        required autofocus>

                </div>

                <div class="form-group" style="display: none;">

                    <input type="text" name="project_owner" class="form-control" value="<?php echo $_SESSION['id'] ?>">

                </div>

                <div class="form-group">
                    <h6>Start Date</h6>
                    <input type="date" name="project_sdate" class="form-control">
                </div>

                <div class="form-group">
                    <h6>End Date</h6>
                    <input type="date" name="project_edate" class="form-control">
                </div>


                <button class="btn btn-lg btn-primary btn-block" type="submit" name='cProject'>Create</button>



            </form>

        </div>
        <div class="col-md-4">

        </div>
    </div>
</div>



<?php

include '../assets/layouts/footer.php'

?>

<script type="text/javascript">
function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);

        }
        reader.readAsDataURL(input.files[0]);
    }
}

$("#avatar").change(function() {
    console.log("here");
    readURL(this);
});
</script>