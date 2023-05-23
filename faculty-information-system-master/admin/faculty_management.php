<?php require('header.php');
require_once('../includes/db_connect.php');
if (isset($_SESSION['stno'])) {
} else {
    header("Location: login.php");
}
include('sidebar.php');
ob_start();
?>

<div class='col-4'>
    <div class="user-list">
        <h3 class="user-list-header">
            List of all Faculty Members </h3>
            <label for="ftitle"><a href="add_faculty.php"><i class="fa fa-plus"></i>Add a faculty</a></label>
        <hr>   
        <?php
            require_once('../OOPClasses/Faculty.php');
            $db = new DBConnect();
            $conn = $db->getConnection();
            $facultyListManager = new Faculty($conn);
            $facultyListManager->getFacultyList();
        ?>  
    </div>
</div>

<style>
    
</style>
<script src="../js/tab.js"></script>
<?php require('../footer.php') ?>