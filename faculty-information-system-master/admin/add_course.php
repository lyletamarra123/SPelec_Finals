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
?>

<div class='col-4'>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $CourseCode = $_POST["CourseCode"] ?? "";
        $CourseName = $_POST["CourseName"] ?? "";
        $FacultyName = $_POST["FacultyName"] ?? "";
        $Department = $_POST["Department"] ?? "";


        $sql = "INSERT INTO courses (CourseCode, CourseName, FacultyName, Department) VALUES (?,?,?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$CourseCode, $CourseName, $FacultyName, $Department]);

        $successMessage = "Course Added Successfully";
        $CourseCode = "";
        $CourseName = "";
        $FacultyName = "";
        $Department = "";
    }
    ?>

    <div class="row">
        <div class="col-8">
            <div class="user-list">
                <h3 class="user-list-header">Add Course section</h3>
                <a href="data_entry_management.php">
                    <li><i class="fa fa-arrow-right">Back</i></li>
                </a>
                <hr>
                <form method="post">
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
                        <div class="col-8">
                            <label for="CourseCode">Course Code</label>
                            <input class="form-input" type="text" id="CourseCode" name="CourseCode" placeholder="..." maxlength="256" required value="<?php echo $CourseCode; ?>">

                            <label for="CourseName">Course Name</label>
                            <input class="form-input" type="text" id="CourseName" name="CourseName" placeholder="..." maxlength="256" required value="<?php echo $CourseName; ?>">
                            
                            <label for="FacultyName">Faculty Name</label>
                            <select class="form-input" id="FacultyName" name="FacultyName" required>
                                <?php
                                $sql = "SELECT `FacultyID`, `FacultyName` FROM `faculty` ORDER BY `FacultyName` ASC";
                                $result = $conn->query($sql);
                                if ($result) {
                                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                        $factID = $row['FacultyID'];
                                        $label = $row['FacultyName'];
                                        $selected = ($factID == $factID) ? 'selected' : '';
                                        echo "<option value=\"$label\" $selected>$label</option>";
                                    }
                                }
                                ?>
                            </select>

                            <label for="Department">Department</label>
                            <select class="form-input" id="Department" name="Department" required>
                                <?php
                                $sql = "SELECT `DepartmentCode`, `DepartmentName` FROM `department`";
                                $result = $conn->query($sql);
                                if ($result) {
                                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                        $deptID = $row['DepartmentCode'];
                                        $label = $row['DepartmentName'];
                                        $selected = ($deptID == $Department) ? 'selected' : '';
                                        echo "<option value=\"$deptID\" $selected>$label</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <input class="btn" type="submit" name="submit" value="Add Course ">
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

<?php require('../footer.php') ?>