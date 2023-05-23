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

require_once('../OOPClasses/UserManager.php');
$db = new DBConnect();
$conn = $db->getConnection();
$userListManager = new UserListManager($conn);

$username = "";
$password = "";
$role_name = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST["username"] ?? "";
    $password = $_POST["password"] ?? "";
    $role_name = $_POST["role_name"] ?? "";

    $userListManager->addUser($username, $password, $role_name);

    $successMessage = "User Added Successfully";

    $username = "";
    $password = "";
    $role_name = "";
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
                <?php if (!empty($successMessage)): ?>
                    <div class="success-message"><?php echo $successMessage; ?></div>
                    <script>
                        setTimeout(function() {
                            var successMessage = document.querySelector('.success-message');
                            successMessage.style.display = 'none';
                        }, 2000);
                    </script>
                <?php endif; ?>
                <form method="post">
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
                    <input class="btn" type="submit" name="submit" value="Add User">
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
