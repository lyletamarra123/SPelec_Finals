<?php

require('.././header.php');
require('sidebar.php');
if (!isset($_SESSION['username'])) {
    header("Location: signin.php");
    exit;
}

require_once("class/Profile.php");

require_once('../includes/info_db_connect.php');
$db = new DBConnectInfo();
$conn = $db->getConnection();


?>

<div>
    <div class="row">
        <div class="col-6">
            <h1>Publications</h1>
            <form method="post" action="update_profile.php">
                <input type="hidden" name="FacultyId" value="<?php echo $profile->getFacultyId(); ?>">
                <!-- Existing fields for updating faculty information -->

                <!-- Publication fields -->
                <label for="PublicationTitle">Publication Title</label>
                <input class="form-input" type="text" id="PublicationTitle" name="PublicationTitle" placeholder="..." maxlength="256">

                <label for="PublicationType">Publication Type</label>
                <input class="form-input" type="text" id="PublicationType" name="PublicationType" placeholder="..." maxlength="256">

                <label for="PublicationDate">Publication Date</label>

        </div>
    </div>
</div>

<?php require('.././footer.php'); ?>