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
            $sql = "SELECT * FROM faculty";
            $result = $conn->query($sql);
            if (!$result) {
                die("Invalid Query: " . $conn->errorInfo()[2]);
                }
                echo "<table>
                    <tr>
                        <th>Faculty ID</th>
                        <th>Faculty Name</th>
                        <th>Position</th>
                        <th>Department</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Action</th>
                        
                    </tr>";

                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo 
                        "<tr>
                            <td>{$row['FacultyID']}</td>
                            <td>{$row['FacultyName']}</td>
                            <td>{$row['Position']}</td>
                            <td>{$row['Department']}</td>
                            <td>{$row['Email']}</td>
                            <td>{$row['PhoneNumber']}</td>               
                            <td>
                                <a href=\"update_faculty.php?FacultyID={$row['FacultyID']}\"><i class='fa fa-edit'></i></a>
                                <a href=\"delete_faculty.php?FacultyID={$row['FacultyID']}\"><i class='fa fa-trash'></i></a>
                            </td>
                        </tr>";
                     }
                echo "</table>";
        ?>
    </div>
</div>

<style>
   

</style>
<script src="../js/tab.js"></script>
<?php require('../footer.php') ?>