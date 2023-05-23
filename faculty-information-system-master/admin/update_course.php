<?php
require('header.php');
require_once('../includes/db_connect.php');

// Check if the user is logged in
if (!isset($_SESSION['stno'])) {
    header("Location: login.php");
    exit;
}

include('sidebar.php');
ob_start();
$CourseCode = "";
$CourseName = "";
$FacultyName = "";
$Department = "";

require_once('../OOPClasses/Course.php');
$db = new DBConnect();
$conn = $db->getConnection();
$courseUpdateForm = new CourseSearch($conn);

$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET['CourseCode'])) {
        header("Location: data_entry_management.php");
        exit;
    }
    $CourseCode = $_GET["CourseCode"];
    $courseUpdateForm->loadCourse($CourseCode);
} 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $CourseCode = $_POST["CourseCode"] ?? "";
    $CourseName = $_POST["CourseName"] ?? "";
    $FacultyName = $_POST["FacultyName"] ?? "";
    $Department = $_POST["Department"] ?? "";

    $courseUpdateForm->updateCourse($CourseCode, $CourseName, $FacultyName, $Department);
}
?>


<div class='col-4'>
    <div class="box">
        <div class="col-8">
            <div class="user-list">
                <h3 class="user-list-header">Update course section</h3>
                <a href="data_entry_management.php">
                    <li><i class="fa fa-arrow-right">Back</i></li>
                </a>
                <hr>
                <div class="row">       
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
                    <input type="hidden" name="CourseCode" value="<?php echo $courseUpdateForm->getCourseCode(); ?>">
                        <div class="col-8">
                        <label for="CourseCode">Course Code</label>
                            <input class="form-input" type="text" id="CourseCode" name="CourseCode" placeholder="..." maxlength="256" required value="<?php echo $courseUpdateForm->getCourseCode(); ?>">

                            <label for="CourseName">Course Name</label>
                            <input class="form-input" type="text" id="CourseName" name="CourseName" placeholder="..." maxlength="256" required value="<?php echo $courseUpdateForm->getCourseName(); ?>">
                            
                            <label for="FacultyName">Faculty Name</label>
                            <select class="form-input" id="FacultyName" name="FacultyName" required>
                                <?php echo $courseUpdateForm->getFacultyOptions($courseUpdateForm->getFacultyName()); ?>
                            </select>

                            <label for="Department">Department</label>
                            <select class="form-input" id="Department" name="Department" required>
                                <?php echo $courseUpdateForm->getDepartmentOptions($courseUpdateForm->getDepartment()); ?>
                            </select>
                        </div>
                    </div>
                    <input class="btn" type="submit" name="submit" value="Update Course">
                    <!-- <a href="faculty_management.php">CANCEL</a> -->
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