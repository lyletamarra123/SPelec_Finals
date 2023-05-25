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
    <table>
        <div class="col-6">
            <h1>Profile</h1>
            <a href="update_profile.php">Edit</a>
            <div class="row">
                <tr><td><strong>Faculty ID:</strong></td> <td><?php echo $facultyId; ?></td></tr>
                <tr><td><strong>Faculty Name:</strong></td> <td><?php echo $facultyName; ?></td></tr>
                <tr><td><strong>Position:</strong></td> <td><?php echo $position; ?></td></tr>
                <tr><td><strong>Department:</strong></td> <td><?php echo $department; ?></td></tr>
                <tr><td><strong>Email:</strong></td> <td><?php echo $email; ?></td></tr>
                <tr><td><strong>Phone Number:</strong></td> <td><?php echo $phoneNumber; ?></td></tr>
            </div>
        </div>
    </table>
    </div>
</div>
<style>
table{
	max-width: 500px;
	border-collapse: collapse;
}
td{
	padding:  1em;
}
tr td:first-child{
	text-align: right;
	font-weight: bold;
}
</style>
<?php require('.././footer.php'); ?>