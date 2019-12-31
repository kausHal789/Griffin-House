<?php 
require_once("./layout/header.php");
require_once("./layout/classes/UploadVideoFormProvider.php");

if(! User::userLoggedIn()) {
    header("Location:signin.php");
    exit(0);
}

?>
<div id="mainContentContainer">
    <div class="column">
        <div class="container p-3">
            <div class="h3 p-1 text-black-50">
                UPLOAD VIDEO
            </div>
            <?php
                $form = new UploadVideoFormProvider($cn);
                echo $form->createUploadVideoForm();
            ?>
        </div>   
    </div>

    <div class="modal fade" id="loadingModal" tabindex="-1" role="dialog" aria-labelledby="loadingModal" aria-hidden="true" data-backdrop="static" data-keyboard=false>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="assets/image/icon/loading-spinner.gif" alt="spinner">
                    <span class="h2">Uploading...</span>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready(function() {
        $('form').submit(function() {
            $('#loadingModal').modal('show');
        });
    });
</script>
<?php require_once("./layout/footer.php");?>