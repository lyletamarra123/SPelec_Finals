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
                <table>
                    <?php foreach ($workHistory as $history) : ?>
                        <tr>
                            <td><strong>Work History ID:</strong></td>
                            <td><?php echo $history['work_history_id']; ?></td>
                            <td><a href="update_work_history.php?id=<?php echo $history['work_history_id']; ?>">Edit</a></td>
                        </tr>
                        <tr>
                            <td><strong>Company Name:</strong></td>
                            <td><?php echo $history['company_name']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Job Title:</strong></td>
                            <td><?php echo $history['job_title']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Start Date:</strong></td>
                            <td><?php echo $history['start_date']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>End Date:</strong></td>
                            <td><?php echo $history['end_date']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Description:</strong></td>
                            <td><?php echo $history['description']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</div>
<style>
table {
    max-width: 500px;
    border-collapse: collapse;
}

td {
    padding: 1em;
}

tr td:first-child {
    text-align: right;
    font-weight: bold;
}
</style>

<?php require('.././footer.php'); ?>