<?php require('header.php');
require_once('../includes/info_db_connect.php');
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
        <a href="add_faculty.php"><i class="fa fa-plus"></i></a>
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
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Contact Info</th>
                            <th>Degrees </th>
                            <th>Grant Awards</th>
                            <th>Offices ID</th>
                            <th>Action</th>
                      
                        </tr>";

                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                            echo "<tr>
                            <td>{$row['faculty_id']}</td>
                            <td>{$row['first_name']}</td>
                            <td>{$row['last_name']}</td>
                            <td>{$row['contact_info']}</td>
                            <td>{$row['degrees']}</td>
                            <td>{$row['grants_awards']}</td>
                            <td>{$row['office_id']}</td>
                         
                            <td>
                                <a href=\"edit_user.php?faculty_id={$row['faculty_id']}\"><i class='fa fa-edit'></i></a>
                                <a href=\"delete_faculty.php?faculty_id= {$row['faculty_id']}\"><i class='fa fa-trash'></i></a>
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