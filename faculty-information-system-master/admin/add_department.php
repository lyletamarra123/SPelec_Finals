<?php require('header.php');
require_once('../includes/db_connect.php');
if (isset($_SESSION['stno'])) {
} else {
    header("Location: login.php");
}
include('sidebar.php');
ob_start();

require_once('../OOPClasses/Department.php');
$db = new DBConnect();
$conn = $db->getConnection();

$DepartmentCode = "";
$DepartmentName = "";
$Email = "";
$Phone = "";
$Location = "";
?>


<div class='col-4'>
    <?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // $department_id = $_POST["department_id"] ?? "";
        $DepartmentCode = $_POST["DepartmentCode"] ?? "";
        $DepartmentName = $_POST["DepartmentName"] ?? "";
        $Email = $_POST["Email"] ?? "";
        $Phone = $_POST["Phone"] ?? "";
        $Location = $_POST["Location"] ?? "";

        $departmentInsertion = new DepartmentSearch($conn);
        $departmentInsertion->insertDepartment($DepartmentCode, $DepartmentName, $Email, $Phone, $Location);

        $successMessage = "Department Added Successfully";

        // Clear user input
        $DepartmentCode = "";
        $DepartmentName = "";
        $Email = "";
        $Phone = "";
        $Location = "";
    }
    ?>


    <div class="row">
        <div class="col-8">
            <div class="user-list">
                <h3 class="user-list-header">Add Department Section </h3>
                <a href="data_entry_management.php">
                    <li><i class="fa fa-arrow-right">Back </i></li>
                </a>
                <hr>
                <form action="" method="post">
                    <div class="row">
                        <?php if (!empty($successMessage)) : ?>
                            <div class="success-message"><?php echo $successMessage; ?></div>
                            <script>
                                setTimeout(function() {
                                    var successMessage = document.querySelector('.success-message');
                                    successMessage.style.display = 'none';
                                }, 3000);
                            </script>
                        <?php endif; ?>
                        <div class="col-8">

                            <label for=" DepartmentCode">Department Code</label>
                            <input class="form-input" type="text" id="DepartmentCode" name="DepartmentCode" placeholder="..." maxlength="256" required value="<?php echo $DepartmentCode; ?>">

                            <label for=" DepartmentName">Department Name</label>
                            <input class="form-input" type="text" id="DepartmentName" name="DepartmentName" placeholder="..." maxlength="256" required value="<?php echo $DepartmentName; ?>">

                            <label for=" Email">Email</label>
                            <input class="form-input" type="text" id="Email" name="Email" placeholder="..." maxlength="256" required value="<?php echo $Email; ?>">

                            <label for=" Phone">Phone</label>
                            <input class="form-input" type="text" id="Phone" name="Phone" placeholder="..." maxlength="256" required value="<?php echo $Phone; ?>">

                            <label for=" Location">Location</label>
                            <input class="form-input" type="text" id="Location" name="Location" placeholder="..." maxlength="256" required value="<?php echo $Location; ?>">
                        </div>
                    </div>

                    <input class="btn" type="submit" name="submit" value="Add Department">
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
<script src="../js/tab.js"></script>
<?php require('../footer.php') ?>