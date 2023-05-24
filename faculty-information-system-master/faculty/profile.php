<?php

require('.././header.php');
require('sidebar.php');

require_once("class/Profile.php");

require_once('../includes/info_db_connect.php');
$db = new DBConnectInfo();
$conn = $db->getConnection();
// Assuming you have a database connection object stored in $conn

$facultyId = $_SESSION['username']; // Assuming $_SESSION['username'] contains the username of the logged-in user
$profile = Profile::fetchProfileFromDatabase($facultyId, $conn);

if ($profile) {
    $facultyId = $profile->getFacultyId();
    $facultyName = $profile->getFacultyName();
    $position = $profile->getPosition();
    $department = $profile->getDepartment();
    $email = $profile->getEmail();
    $phoneNumber = $profile->getPhoneNumber();
} else {
    // Handle the case when profile is not found
    echo "Profile not found.";
}
?>

<div>
    <div class="row">
        <div class="col-6">
            <h1>Profile</h1>
            <a href="update_profile.php">Edit</a>
            <div class="row">
                <p><strong>Faculty ID:</strong> <?php echo $facultyId; ?></p>
                <p><strong>Faculty Name:</strong> <?php echo $facultyName; ?></p>
                <p><strong>Position:</strong> <?php echo $position; ?></p>
                <p><strong>Department:</strong> <?php echo $department; ?></p>
                <p><strong>Email:</strong> <?php echo $email; ?></p>
                <p><strong>Phone Number:</strong> <?php echo $phoneNumber; ?></p>
            </div>

        </div>
    </div>
</div>

<?php require('.././footer.php'); ?>