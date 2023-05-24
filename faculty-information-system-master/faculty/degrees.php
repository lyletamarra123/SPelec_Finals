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
$degrees = Profile::fetchDegreeFromDatabase($facultyId, $conn);
// var_dump($facultyId);
?>

<div>
    <div class="row">
        <div class="col-6">
            <h1>Degrees</h1>
            <a href="update_profile.php">Edit</a>
            <div class="row">
                <?php foreach ($degrees as $degree) : ?>
                    <h2>Degree: <?php echo $degree['degree']; ?></h2>
                    <p>Degree ID: <?php echo $degree['degree_id']; ?></p>
                    <p>Date Attained: <?php echo $degree['date_attained']; ?></p>
                    <p>Institution: <?php echo $degree['institution']; ?></p>
                    <?php
                    // Additional degree-specific details can be displayed here
                    ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?php require('.././footer.php'); ?>