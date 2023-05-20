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

$department_id = "";
$department_name = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET['department_id'])) {
        header("Location: data_entry_management.php");
        exit;
    }
    $department_id = $_GET["department_id"];
    $sql = "SELECT * FROM departments WHERE department_id = $department_id";
    $result = $conn->query($sql);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    if (!$row) {
        header("Location: data_entry_management.php");
        exit;
    }
    $department_id = $row["department_id"];
    $department_name = $row["department_name"];

    $successMessage = "User Added Successfully";

    // Clear user input

} else {

    $department_id = $_POST["department_id"];
    $department_name = $_POST["department_name"];

    $sql = "UPDATE departments " .
        "SET department_id = '$department_id', department_name = '$department_name'" .
        "WHERE department_id = $department_id";

    $result = $conn->query($sql);

    if ($result) {

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
                <h3 class="user-list-header">Add Department Section </h3>
                <a href="data_entry_management.php">
                    <li><i class="fa fa-arrow-right">Back </i></li>
                </a>
                <hr>
                <form action="" method="post">
                    <input type="hidden" name="department_id" value="<?php echo $department_id; ?>">
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

                            <label for=" departmentName">Department Name</label>
                            <input class="form-input" type="text" id="departmentName" name="department_name" placeholder="..." maxlength="256" required value="<?php echo $department_name; ?>">
                        </div>
                    </div>

                    <input class="btn" type="submit" name="submit" value="Update  Department">
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