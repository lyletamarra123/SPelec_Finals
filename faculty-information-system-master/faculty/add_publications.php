<?php
require('.././header.php');
require('sidebar.php');
?>
<?php

require_once("class/Profile.php");
require_once('../includes/info_db_connect.php');

$db = new DBConnectInfo();
$conn = $db->getConnection();

$facultyId = $_SESSION['username'];
$profile = Profile::fetchProfileFromDatabase($facultyId, $conn);


if ($profile) {
    $facultyId = $profile->getFacultyId();
} else {
    // Handle the case when profile is not found
    echo "Profile not found.";
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $publicationId = rand(); // Generate a random publication ID
    $title = $_POST["publication_title"] ?? "";
    $publicationType = $_POST["publication_type"] ?? "";
    $publicationDate = $_POST["publication_date"] ?? "";

    $profile->addPublication($publicationId, $title, $publicationType, $publicationDate, $facultyId, $conn);
    $successMessage = "Publication added successfully";

    // Perform any additional actions or redirect the user as needed


}
?>

<div class='col-4'>
    <div class="box">
        <div class="col-3">
            <div class="user-list">
                <h3 class="user-list-header">Add publication section</h3>
                <a href="publication.php">
                    <li><i class="fa fa-arrow-right">Back</i></li>
                </a>
                <hr>
                <?php if (!empty($successMessage)) : ?>
                    <div class="success-message"><?php echo $successMessage; ?></div>
                    <script>
                        setTimeout(function() {
                            var successMessage = document.querySelector('.success-message');
                            successMessage.style.display = 'none';
                        }, 2000);
                    </script>
                <?php endif; ?>
                <form method="post">

                    <label for="publicationTitle">Publication Title</label>
                    <input class="form-input" type="text" id="publication_title" name="publication_title" required>

                    <label for="publicationType">Publication Type</label>
                    <input class="form-input" type="text" id="publication_type" name="publication_type" required>

                    <label for="publicationDate">Publication Date</label>
                    <input class="form-input" type="text" id="publication_date" name="publication_date" placeholder="YYYY-MM-DD" required>


                    <input class="btn" type="submit" name="submit" value="Add Publication  ">
                    <!-- <a href="data_entry_management.php">CANCEL</a> -->
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    /* Rest of your CSS code */

    .success-message {
        color: green;
        font-weight: bold;
        margin-bottom: 10px;
    }
</style>