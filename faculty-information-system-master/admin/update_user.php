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

$user_id = "";
$username = "";
$password = "";
$role_name = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET['user_id'])) {
        header("Location: user_management.php");
        exit;
    }
    $user_id = $_GET["user_id"];
    $sql = "SELECT * FROM users WHERE user_id = $user_id";
    $result = $conn->query($sql);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    if (!$row) {
        header("Location: user_management.php");
        exit;
    }
    $username = $row["username"];
    $password = $row["password"];
    $role_name = $row["role_name"];

    // Clear user input

} else {

    $user_id = $_POST["user_id"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $role_name = $_POST["role_name"];


    $sql = "UPDATE users ". 
    "SET user_id = '$user_id', username = '$username', password = '$password', role_name = '$role_name'". 
    "WHERE user_id = $user_id";

    $result = $conn->query($sql);

    if ($result) {
        // Redirect to user_management.php after successful update
        $successMessage = "User Updated Successfully";
        header("Location: user_management.php");
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
                <a href="user_management.php">
                    <li><i class="fa fa-arrow-right">Back</i></li>
                </a>
                <hr>
                
                <form method="post">
                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                    <div class="row">
                        <div class="col-8">
                            <label for="username">Username</label>
                            <input class="form-input" type="text" id="username" name="username" placeholder="..." maxlength="256" required value="<?php echo $username; ?>">

                            <label for="password">Password</label>
                            <input class="form-input" type="password" id="password" name="password" placeholder="..." maxlength="256" required value="<?php echo $password; ?>">
                            
                            <label for="role">Role</label>
                            <select class="form-input" id="role" name="role_name" required>
                                <option value="Admin" <?php if ($role_name == 'Admin') echo 'selected'; ?>>Admin</option>
                                <option value="Faculty" <?php if ($role_name == 'Faculty') echo 'selected'; ?>>Faculty</option>
                                <option value="Guest" <?php if ($role_name == 'Guest') echo 'selected'; ?>>Guest</option>
                                <option value="Students" <?php if ($role_name == 'Students') echo 'selected'; ?>>Students</option>
                            </select>
                        </div>
                    </div>
                    <input class="btn" type="submit" name="submit" value="Update User">
                    <a href="user_management.php">CANCEL</a>
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