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
$workHistory = Profile::fetchWorkHistoryFromDatabase($facultyId, $conn);

// var_dump($workHistory);

?>


<div>
    <div class="row">
        <div class="col-6">
            <h1>Work History</h1>
            <a href="add_work_history.php">Add</a>
            <div class="row">
                <?php foreach ($workHistory as $history) : ?>
                    <h2>Work History ID: <?php echo $history['work_history_id']; ?>
                    <a href="update_work_history.php?id=<?php echo $history['work_history_id']; ?>"> Edit</a></h2>
                    <p>Company Name: <?php echo $history['company_name']; ?></p>
                    <p>Job Title: <?php echo $history['job_title']; ?></p>
                    <p>Start Date: <?php echo $history['start_date']; ?></p>
                    <p>End Date: <?php echo $history['end_date']; ?></p>
                    <p>Description: <?php echo $history['description']; ?></p>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
</div>

<?php require('.././footer.php'); ?>