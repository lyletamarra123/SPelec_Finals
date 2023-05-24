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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $work_history_id = rand();
    $company_name = $_POST["company_name"] ?? "";
    $job_title = $_POST["job_title"] ?? "";
    $start_date = $_POST["start_date"] ?? "";
    $end_date = $_POST["end_date"] ?? "";
    $description = $_POST["description"] ?? "";

    $profile->addWorkHistory($work_history_id, $facultyId, $company_name, $job_title, $start_date, $end_date, $description, $conn);
    $successMessage = "added succesfuly";
    // Perform any additional actions or redirect the user as needed


}
// var_dump($workHistory);

?>

<div>
    <div class="row">
        <div class="col-3">
            <h1>Add Work History</h1>
            <a href = "work_history.php">Back</a>
            <div class="row">
                <form method="post">
                    <?php if (!empty($successMessage)) : ?>
                        <div class="success-message"><?php echo $successMessage; ?></div>
                        <script>
                            setTimeout(function() {
                                var successMessage = document.querySelector('.success-message');
                                successMessage.style.display = 'none';
                            }, 2000);
                        </script>
                    <?php endif; ?>
                    <label for="companyname">Company name</label>
                    <input class="form-input" type="text" id="company_name" name="company_name" required>

                    <label for="jobTitle">Job Title</label>
                    <input class="form-input" type="text" id="job_title" name="job_title" maxlength="256" required>

                    <label for="startDate">Start Date</label>
                    <input class="form-input" type="text" id="start_date" name="start_date" maxlength="256" required>

                    <label for="endDate">End Date</label>
                    <input class="form-input" type="text" id="end_date" name="end_date" placeholder="YY - MM - DD" maxlength="256">

                    <label for="description">Description</label>
                    <textarea class="form-input" id="description" name="description" rows="4" required maxlength="256"></textarea>

                    <input class="btn" type="submit" name="submit" value="Add Work History">
                </form>
            </div>
        </div>
    </div>
</div>
<style>
        .success-message {
        color: green;
        font-weight: bold;
        margin-bottom: 10px;
    }
</style>

<?php require('.././footer.php'); ?>