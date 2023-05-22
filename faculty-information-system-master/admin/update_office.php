
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

$office_id = "";
$office_address = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET['office_id'])) {
        header("Location: data_entry_management.php");
        exit;
    }
    $office_id = $_GET["office_id"];
    $sql = "SELECT * FROM offices WHERE office_id = $office_id";
    $result = $conn->query($sql);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    if (!$row) {
        header("Location: data_entry_management.php");
        exit;
    }

    $office_id = $row["office_id"];
    $office_address = $row["office_address"];

    $successMessage = "User Added Successfully";

    // Clear user input

} else {

    $office_id = $_POST["office_id"];
    $office_address = $_POST["office_address"];



    $sql = "UPDATE offices ". 
    "SET office_id = '$office_id', office_address = '$office_address'". 
    "WHERE office_id = $office_id";

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
    <div class="row">
        <div class="col-8">
            <div class="user-list">
                <h3 class="user-list-header">Add Office Section </h3>
                <a href="data_entry_management.php">
                    <li><i class="fa fa-arrow-right">Back </i></li>
                </a>
                <hr>
                <form action="" method="post">
                <input type="hidden" name="office_id" value="<?php echo $office_id; ?>">
                    <div class="row">
   
                        <div class="col-8">

                            <label for=" Office Adress">Office Adress</label>
                            <input class="form-input" type="text" id="office_address" name="office_address" placeholder="..." maxlength="256" required value="<?php echo $office_address; ?>">
                        </div>
                    </div>

                    <input class="btn" type="submit" name="submit" value="Update office">
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