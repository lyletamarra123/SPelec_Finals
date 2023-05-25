<?php require('header.php');
require_once('../includes/db_connect.php');
if (isset($_SESSION['stno'])) {
} else {
    header("Location: login.php");
}
include('sidebar.php');
ob_start();
?>



<style>
    
</style>
<script src="../js/tab.js"></script>
<?php require('../footer.php') ?>