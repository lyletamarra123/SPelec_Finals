<?php

require('.././header.php');
require('sidebar.php');
ob_start();
require_once('../includes/info_db_connect.php');
$db = new DBConnectInfo();
$conn = $db->getConnection();

$workHistoryId = $_GET['id'] ?? null;
require_once("class/WorkHistory.php");
require_once("class/Profile.php");

if (!isset($_SESSION['username'])) {
    header("Location: signin.php");
    exit;
}
$facultyId = $_SESSION['username'];
$profile = Profile::fetchProfileFromDatabase($facultyId, $conn);

$workHistory = WorkHistory::fetchWorkHistoryFromDatabase($workHistoryId, $conn);

if (!$workHistory) {
    echo "not found";
    exit;
}
// if (!$workHistory) {
//     // Handle the case when profile is not found
//     echo "work History not found.";
//     exit;
// }
if ($profile) {
    $facultyId = $profile->getFacultyId();
} else {
    // Handle the case when profile is not found
    echo "Profile not found.";
}

$companyName = $workHistory->getCompanyName();
$jobTitle = $workHistory->getJobTitle();
$startDate = $workHistory->getStartDate();
$endDate = $workHistory->getEndDate();
$description = $workHistory->getDescription();

$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle work history updates
echo "hi";
    $workHistoryId = $_POST['WorkHistoryId'];
    $companyName = $_POST['CompanyName'];
    $jobTitle = $_POST['JobTitle'];
    $startDate = $_POST['StartDate'];
    $endDate = $_POST['EndDate'];
    $description = $_POST['Description'];

    $workHistory = new WorkHistory(
        $workHistoryId,
        $facultyId,
        $companyName,
        $jobTitle,
        $startDate,
        $endDate,
        $description
    );


    $workHistory->updateWorkHistory($conn);
    header('Location: profile.php');
    exit();
}
?>

<div class='col-4'>
    <div class="box">
        <div class="col-8">
            <div class="user-list">
                <h1 class="user-list-header">Work History</h1>
                <a href="work_history.php">
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
                <form method="post" action="update_work_history.php">
                    <input type="hidden" name="workHistoryId" value="<?php echo $workHistoryId; ?>">
                    <div class="row">
                        <div class="col-8">
                            <label for="CompanyName">Company Name</label>
                            <input class="form-input" type="text" id="CompanyName" name="companyName" placeholder="..." maxlength="256" required value="<?php echo $companyName; ?>">

                            <label for="JobTitle">Job Title</label>
                            <input class="form-input" type="text" id="JobTitle" name="jobTitle" placeholder="..." maxlength="256" required value="<?php echo $jobTitle; ?>">

                            <label for="StartDate">Start Date</label>
                            <input class="form-input" type="text" id="StartDate" name="startDate" placeholder="..." maxlength="256" required value="<?php echo $startDate; ?>">

                            <label for="EndDate">End Date</label>
                            <input class="form-input" type="text" id="EndDate" name="endDate" placeholder="..." maxlength="256" value="<?php echo $endDate; ?>">

                            <label for="Description">Description</label>
                            <textarea class="form-input" id="Description" name="description" placeholder="..." required><?php echo $description; ?></textarea>
                        </div>
                    </div>
                    <input class="btn" type="submit" name="submit" value="Update Work History">
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    /* CSS styles */

    .user-list {
        border: 1px solid #ccc;
        padding: 10px;
        width: 100%;
        background-color: #f7f7f7;
    }

    .user-list ul {
        list-style-type: none;
        padding: 0;
    }

    .user-list li {
        border-bottom: 1px solid #ccc;
        padding: 5px 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .icons {
        display: flex;
        gap: 10px;
    }

    .icons:last-child {
        margin-left: auto;
    }

    .icon {
        display: flex;
        align-items: flex-end;

    }

    .user-list-header {
        margin-right: 10px;
    }

    .box {
        padding-bottom: 30%;
    }

    .success-message {
        color: green;
        font-weight: bold;
        margin-bottom: 10px;
    }
</style>

<?php require('.././footer.php'); ?>