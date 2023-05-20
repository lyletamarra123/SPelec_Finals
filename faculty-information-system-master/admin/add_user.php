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
$user_id = rand();
$username = "";
$password = "";
$role_id = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST["username"] ?? "";
    $password = $_POST["password"] ?? "";
    $role_id = $_POST["role_id"] ?? "";

    // Generate a unique user ID
    // $userid = uniqid();

    $sql = "INSERT INTO users (user_id, username, password, role_id) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$user_id, $username, $password, $role_id]);

    $successMessage = "User Added Successfully";

    // Clear user input
    $user_id= rand();
    $username = "";
    $password = "";
    $role_id = "";
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
                            <select class="form-input" id="role" name="role_id" required>
                                <option value="1" <?php if ($role_id == 1) echo 'selected'; ?>>Admin</option>
                                <option value="2" <?php if ($role_id == 2) echo 'selected'; ?>>Faculty</option>
                                <option value="3" <?php if ($role_id == 3) echo 'selected'; ?>>Guest</option>
                                <option value="4" <?php if ($role_id == 4) echo 'selected'; ?>>Students</option>
                            </select>
                        </div>
                    </div>
                    <input class="btn" type="submit" name="submit" value="Add User">
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