<?php
require('header.php');
require_once('../includes/info_db_connect.php');

// Check if the user is logged in
if (!isset($_SESSION['stno'])) {
    header("Location: login.php");
    exit;
}

include('sidebar.php');
ob_start();

$course_id = "";
$course_name = "";
$department_id = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET['course_id'])) {
        header("Location: data_entry_management.php");
        exit;
    }
    $course_id = $_GET["course_id"];
    $sql = "SELECT * FROM courses WHERE course_id = $course_id";
    $result = $conn->query($sql);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    if (!$row) {
        header("Location: data_entry_management.php");
        exit;
    }
    $course_id = $row["course_id"];
    $course_name = $row["course_name"];
    $department_id = $row["department_id"];


    $successMessage = "User Added Successfully";

    // Clear user input

} else {

    $course_id = $_POST["course_id"];
    $course_name = $_POST["course_name"];
    $department_id = $_POST["department_id"];



    $sql = "UPDATE courses " .
        "SET course_id = '$course_id', course_name = '$course_name', department_id = '$department_id'" .
        "WHERE course_id = $course_id";

    $result = $conn->query($sql);

    if ($result) {
        // Redirect to user_management.php after successful update
        header("Location: data_entry_management.php");
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
                <h3 class="user-list-header">Add user section</h3>
                <a href="data_entry_management.php">
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
                    <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
                    <div class="row">
                        <div class="col-8">
                            <label for="course_name">course_name</label>
                            <input class="form-input" type="text" id="course_name" name="course_name" placeholder="..." maxlength="256" required value="<?php echo $course_name; ?>">

                            <label for="department_id">department</label>
                            <select class="form-input" id="department_id" name="department_id" required>
                                <?php
                                $sql = "SELECT department_id, department_name FROM departments";
                                $result = $conn->query($sql);
                                if ($result) {
                                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                        $deptID = $row['department_id'];
                                        $label = $row['department_name'];
                                        $selected = ($deptID == $deptID) ? 'selected' : '';
                                        echo "<option value=\"$deptID\" $selected>$label</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <input class="btn" type="submit" name="submit" value="update Courses ">
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