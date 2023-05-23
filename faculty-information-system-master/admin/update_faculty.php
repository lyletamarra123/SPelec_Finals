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

require_once('../OOPClasses/Faculty.php');
$db = new DBConnect();
$conn = $db->getConnection();
$facultyUpdateForm = new Faculty($conn);

$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET['FacultyID'])) {
        header("Location: faculty_management.php");
        exit;
    }

    $facultyID = $_GET["FacultyID"];
    $facultyUpdateForm->loadFaculty($facultyID);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $facultyID = $_POST["FacultyID"];
    $facultyName = $_POST["FacultyName"];
    $position = $_POST["Position"];
    $department = $_POST["Department"];
    $email = $_POST["Email"];
    $phoneNumber = $_POST["PhoneNumber"];

    $facultyUpdateForm->updateFaculty($facultyID, $facultyName, $position, $department, $email, $phoneNumber);
}

?>

<div class='col-4'>
    <div class="box">
        <div class="col-8">
            <div class="user-list">
                <h3 class="user-list-header">Update Faculty Section</h3>
                <a href="faculty_management.php">
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
                <form method="post">
                    <input type="hidden" name="FacultyID" value="<?php echo $facultyUpdateForm->getFacultyID(); ?>">
                    <div class="row">
                        <div class="col-8">
                            <label for="FacultyName">Faculty Name</label>
                            <input class="form-input" type="text" id="FacultyName" name="FacultyName" placeholder="..." maxlength="256" required value="<?php echo $facultyUpdateForm->getFacultyName(); ?>">

                            <label for="Position">Position</label>
                            <input class="form-input" type="text" id="Position" name="Position" placeholder="..." maxlength="256" required value="<?php echo $facultyUpdateForm->getPosition(); ?>">

                            <label for="Department">Department</label>
                            <input class="form-input" type="text" id="Department" name="Department" placeholder="..." maxlength="256" required value="<?php echo $facultyUpdateForm->getDepartment(); ?>">

                            <label for="Email">Email</label>
                            <input class="form-input" type="text" id="Email" name="Email" placeholder="..." maxlength="256" required value="<?php echo $facultyUpdateForm->getEmail(); ?>">

                            <label for="PhoneNumber">Phone Number</label>
                            <input class="form-input" type="text" id="PhoneNumber" name="PhoneNumber" placeholder="..." maxlength="256" required value="<?php echo $facultyUpdateForm->getPhoneNumber(); ?>">
                        </div>
                    </div>
                    <input class="btn" type="submit" name="submit" value="Update Faculty">
                </form>
            </div>
        </div>
    </div>
</div>

<style>
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

<?php require('../footer.php') ?>
