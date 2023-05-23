<?php
require_once('header.php');
require_once('../includes/db_connect.php');

// Check if the user is logged in
if (!isset($_SESSION['stno'])) {
    header("Location: login.php");
    exit;
}

include('sidebar.php');
ob_start();

$DepartmentCode = "";
$DepartmentName = "";
$Email = "";
$Phone = "";
$Location = "";

require_once('../OOPClasses/Department.php');
$db = new DBConnect();
$conn = $db->getConnection();
$departmentUpdateForm = new DepartmentSearch($conn);

$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET['DepartmentCode'])) {
        header("Location: data_entry_management.php");
        exit;
    }

    $DepartmentCode = $_GET["DepartmentCode"];
    $departmentUpdateForm->loadDepartment($DepartmentCode);
} 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $DepartmentCode = $_POST["DepartmentCode"];
    $DepartmentName = $_POST["DepartmentName"];
    $Email = $_POST["Email"];
    $Phone = $_POST["Phone"];
    $Location = $_POST["Location"];

    $departmentUpdateForm->updateDepartment($DepartmentCode, $DepartmentName, $Email, $Phone, $Location);
}
?>
<div class='col-4'>
    <div class="row">
        <div class="col-6">
            <div class="user-list">
                <h3 class="user-list-header">Update Department Section </h3>
                <a href="data_entry_management.php">
                    <li><i class="fa fa-arrow-right">Back </i></li>
                </a>
                <hr>
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
                </div>
                <form action="" method="post">
                    <input type="hidden" name="DepartmentCode" value="<?php echo $departmentUpdateForm->getDepartmentCode(); ?>">
                    <div class="col-8">
                        <label for="DepartmentCode">Department Code</label>
                        <input class="hidden" type="text" id="DepartmentCode" name="DepartmentCode" placeholder="..." maxlength="256" required value="<?php echo $departmentUpdateForm->getDepartmentCode(); ?>">

                        <label for=" DepartmentName">Department Name</label>
                        <input class="form-input" type="text" id="DepartmentName" name="DepartmentName" placeholder="..." maxlength="256" required value="<?php echo $departmentUpdateForm->getDepartmentName(); ?>">

                        <label for=" Email">Email</label>
                        <input class="form-input" type="text" id="Email" name="Email" placeholder="..." maxlength="256" required value="<?php echo $departmentUpdateForm->getEmail(); ?>">

                        <label for=" Phone">Phone</label>
                        <input class="form-input" type="text" id="Phone" name="Phone" placeholder="..." maxlength="256" required value="<?php echo $departmentUpdateForm->getPhone(); ?>">

                        <label for=" Location">Location</label>
                        <input class="form-input" type="text" id="Location" name="Location" placeholder="..." maxlength="256" required value="<?php echo $departmentUpdateForm->getLocation(); ?>">
                    </div>
                    <input class="btn" type="submit" name="submit" value="Update Department">
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