<?php

require('.././header.php');
require('sidebar.php');

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
$awards = Profile::fetchAwardsFromDatabase($facultyId, $conn);
// var_dump($facultyId);

?>
<div>
    <div class="row">
        <div class="col-6">
            <h1>Awards</h1>
            <a href="update_profile.php">Edit</a>
            <div class="row">
                <?php foreach ($awards as $award) : ?>
                    <h2>Award: <?php echo $award['grant_award']; ?></h2>
                    <p>Award ID: <?php echo $award['grant_award_id']; ?></p>
                    <p>Date Attained: <?php echo $award['date_attained']; ?></p>
                    <?php
                    ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?php require('.././footer.php'); ?>