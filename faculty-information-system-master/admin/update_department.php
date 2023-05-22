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

$DepartmentCode = "";
$DepartmentName = "";
$Email = "";
$Phone = "";
$Location = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET['DepartmentCode'])) {
        header("Location: data_entry_management.php");
        exit;
    }
    $DepartmentCode = $_GET["DepartmentCode"];
    $sql = "SELECT * FROM department WHERE DepartmentCode = '$DepartmentCode'";
    $result = $conn->query($sql);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    if (!$row) {
        header("Location: data_entry_management.php");
        exit;
    }
    $DepartmentCode = $row["DepartmentCode"];
    $DepartmentName = $row["DepartmentName"];
    $Email = $row["Email"];
    $Phone = $row["Phone"];
    $Location = $row["Location"];


    // Clear user input

} else {
    $DepartmentCode = $_POST["DepartmentCode"];
    $DepartmentName = $_POST["DepartmentName"];
    $Email = $_POST["Email"];
    $Phone = $_POST["Phone"];
    $Location = $_POST["Location"];

    $sql = "UPDATE department " .
        "SET DepartmentCode = '$DepartmentCode', DepartmentName = '$DepartmentName', Email = '$Email', Phone = '$Phone', Location = '$Location'" .
        "WHERE DepartmentCode = '$DepartmentCode'";

    $result = $conn->query($sql);

    if ($result) {
        $successMessage = "Department updated Successfully";
        header("Location: data_entry_management.php");
        exit;
    } else {
        die("Invalid Query: " . $conn->errorInfo()[2]);
    }
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
                    <input type="hidden" name="DepartmentCode" value="<?php echo $DepartmentCode; ?>">
                        <div class="col-8">
                            <label for="DepartmentCode">Department Code</label>
                            <input class="hidden" type="text" id="DepartmentCode" name="DepartmentCode" placeholder="..." maxlength="256" required value="<?php echo $DepartmentCode; ?>">

                            <label for=" DepartmentName">Department Name</label>
                            <input class="form-input" type="text" id="DepartmentName" name="DepartmentName" placeholder="..." maxlength="256" required value="<?php echo $DepartmentName; ?>">

                            <label for=" Email">Email</label>
                            <input class="form-input" type="text" id="Email" name="Email" placeholder="..." maxlength="256" required value="<?php echo $Email; ?>">

                            <label for=" Phone">Phone</label>
                            <input class="form-input" type="text" id="Phone" name="Phone" placeholder="..." maxlength="256" required value="<?php echo $Phone; ?>">

                            <label for=" Location">Location</label>
                            <input class="form-input" type="text" id="Location" name="Location" placeholder="..." maxlength="256" required value="<?php echo $Location; ?>">
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