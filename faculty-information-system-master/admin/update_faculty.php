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

$FacultyID ="";
$FacultyName = "";
$Position = "";
$Department = "";
$Email = "";
$PhoneNumber = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET['FacultyID'])) {
        header("Location: faculty_management.php");
        exit;
    }
    $FacultyID = $_GET["FacultyID"];
    $sql = "SELECT * FROM faculty WHERE FacultyID = '$FacultyID'";
    $result = $conn->query($sql);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    if (!$row) {
        header("Location: faculty_management.php");
        exit;
    }
    // $FacultyID = $row["FacultyID"];
    $FacultyName = $row["FacultyName"];
    $Position = $row["Position"];
    $Department = $row["Department"];
    $Email = $row["Email"];
    $PhoneNumber = $row["PhoneNumber"];

    // Clear user input

} else {

    $FacultyID = $_POST["FacultyID"];
    $FacultyName = $_POST["FacultyName"];
    $Position = $_POST["Position"];
    $Department = $_POST["Department"];
    $Email = $_POST["Email"];
    $PhoneNumber = $_POST["PhoneNumber"];


    $sql = "UPDATE faculty " .
        "SET FacultyName = '$FacultyName', Position = '$Position', Department = '$Department', Email = '$Email', PhoneNumber = '$PhoneNumber' " .
        "WHERE FacultyID = '$FacultyID'";

    $result = $conn->query($sql);

    if ($result) {
        // Redirect to user_management.php after successful update
        $successMessage = "User updated Successfully";
        header("Location: faculty_management.php");
        exit;
    } else {
        die("Invalid Query: " . $conn->errorInfo()[2]);
    }
}
?>

<div class='col-4'>
    <div class="box">
        <div class="col-8">
            <div class="user-list">
                <h3 class="user-list-header">Update faculty section</h3>
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
                    <input type="hidden" name="FacultyID" value="<?php echo $FacultyID; ?>">  
                    <div class="row">
                        <div class="col-8">
                        <label for="FacultyName">Faculty Name</label>
                            <input class="form-input" type="text" id="FacultyName" name="FacultyName" placeholder="..." maxlength="256" required value="<?php echo $FacultyName; ?>">


                            <label for="Position">Position</label>
                            <input class="form-input" type="text" id="Position" name="Position" placeholder="..." maxlength="256" required value="<?php echo $Position; ?>">

                            <label for="Department">Department</label>
                            <input class="form-input" type="text" id="Department" name="Department" placeholder="..." maxlength="256" required value="<?php echo $Department; ?>">


                            <label for="Email">Email</label>
                            <input class="form-input" type="text" id="Email" name="Email" placeholder="..." maxlength="256" required value="<?php echo $Email; ?>">


                            <label for="PhoneNumber">Phone Number</label>
                            <input class="form-input" type="text" id="PhoneNumber" name="PhoneNumber" placeholder="..." maxlength="256" required value="<?php echo $PhoneNumber; ?>">
                        </div>
                    </div>
                    <input class="btn" type="submit" name="submit" value="Update Faculty ">
                    <a href="faculty_management.php">CANCEL</a>
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

<?php require('../footer.php') ?>