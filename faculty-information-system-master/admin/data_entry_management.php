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
    <div class="tab center">
        <button class="tablinks" onclick="openTab(event, 'Add')" id="defaultOpen">Department</button>
        <button class="tablinks" onclick="openTab(event, 'Course')">Courses Offerd</button>
        <button class="tablinks" onclick="openTab(event, 'Publication')">Publication </button>
        <button class="tablinks" onclick="openTab(event, 'Jobs')">Jobs </button>
        <button class="tablinks" onclick="openTab(event, 'Offices')">Offices </button>
    </div>
    <div id="Add" class="tabcontent">
        <form action=">" method="post">
            <div class="row">
                <div class="col-10">
                    <div class="user-list">
                        <label for="ftitle">All Departments <a href="add_department.php"><i class="fa fa-plus"></i></a></label>
                        <hr>
                        <?php
                        $sql = "SELECT * FROM departments";
                        $result = $conn->query($sql);
                        if (!$result) {
                            die("Invalid Query: " . $conn->errorInfo()[2]);
                        }
                        echo "<table>
                        <tr>
                            <th>ID</th>
                            <th>Department</th>
                            <th>Action</th>
                      
                        </tr>";

                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                            echo "<tr>
                            <td>{$row['department_id']}</td>
                            <td>{$row['department_name']}</td>
                         
                            <td>
                                <a href=\"update_department.php?department_id={$row['department_id']}\"><i class='fa fa-edit'></i></a>
                                <a href=\"delete_department.php?department_id={$row['department_id']}\"><i class='fa fa-trash'></i></a>
                            </td>
                        </tr>";
                        }

                        echo "</table>";
                        ?>

                    </div>
                </div>
            </div>

        </form>
    </div>

    <div id="Course" class="tabcontent">
        <form action=">" method="post">
            <div class="row">
                <div class="col-10">
                    <div class="user-list">
                        <label for="ftitle">All Courses <a href="add_course.php
                        "><i class="fa fa-plus"></i></a></label>

                        <hr>
                        <?php
                        $sql = "SELECT * FROM courses";
                        $result = $conn->query($sql);
                        if (!$result) {
                            die("Invalid Query: " . $conn->errorInfo()[2]);
                        }
                        echo "<table>
                        <tr>
                            <th>Department ID</th>
                            <th>course ID</th>
                            <th>Course Name</th>
                            <th>Action</th>
                      
                        </tr>";

                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                            echo "<tr>
                            <td>{$row['department_id']}</td>
                            <td>{$row['course_id']}</td>
                            <td>{$row['course_name']}</td>
                     
                         
                            <td>
                                <a href=\"edit_user.php?course_id={$row['course_id']}\"><i class='fa fa-edit'></i></a>
                                <a href=\"delete_course.php?course_id= {$row['course_id']}\"><i class='fa fa-trash'></i></a>
                            </td>
                        </tr>";
                        }
                        echo "</table>";
                        ?>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div id="Publication" class="tabcontent">
        <form action=">" method="post">
            <div class="row">
                <div class="col-12">
                    <div class="user-list">
                        <label for="ftitle">Books Publication <a href="add_publication.php"><i class="fa fa-plus"></i> </a></label>
                        <hr>
                        <?php
                        $sql = "SELECT * FROM publications";
                        $result = $conn->query($sql);
                        if (!$result) {
                            die("Invalid Query: " . $conn->errorInfo()[2]);
                        }
                        echo "<table>
                        <tr>
                            <th>Publication ID</th>
                            <th>Faculty ID</th>
                            <th>Title </th>
                            <th>Author </th>
                            <th>Publication Type </th>
                            <th>Action</th>
                      
                        </tr>";

                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                            echo "<tr>
                            <td>{$row['publication_id']}</td>
                            <td>{$row['faculty_id']}</td>
                            <td>{$row['title']}</td>
                            <td>{$row['author']}</td>
                            <td>{$row['publication_type_id']}</td>
                      
                     
                         
                            <td>
                                <a href=\"edit_publication.php?publication_id={$row['publication_id']}\"><i class='fa fa-edit'></i></a>
                                <a href=\"delete_publication.php?publication_id= {$row['publication_id']}\"><i class='fa fa-trash'></i></a>
                            </td>
                        </tr>";
                        }
                        echo "</table>";
                        ?>
                    </div>
                 
                </div>
            </div>

        </form>
    </div>
    <div id="Jobs" class="tabcontent">
        <form action=">" method="post">
            <div class="row">
                <div class="col-12">
                    <div class="user-list">
                        <label for="ftitle">Job Type <a href="add_job.php"><i class="fa fa-plus"></i></a></label>
                        <hr>
                        <?php
                        $sql = "SELECT * FROM job_types";
                        $result = $conn->query($sql);
                        if (!$result) {
                            die("Invalid Query: " . $conn->errorInfo()[2]);
                        }
                        echo "<table>
                        <tr>
                            <th>Job ID</th>
                            <th>Job Type ID</th>
                            <th>Action</th>
                      
                        </tr>";

                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                            echo "<tr>
                            <td>{$row['job_type_id']}</td>
                            <td>{$row['job_type_name']}</td>
                         
                     
                         
                            <td>
                                <a href=\"edit_user.php?job_type_id={$row['job_type_id']}\"><i class='fa fa-edit'></i></a>
                                <a href=\"delete_job.php?job_type_id= {$row['job_type_id']}\"><i class='fa fa-trash'></i></a>
                            </td>
                        </tr>";
                        }
                        echo "</table>";
                        ?>  
                      
                    </div>
                   
                </div>
            </div>
           
        </form>

    </div>

    <div id="Offices" class="tabcontent">
        <form action=">" method="post">
            <div class="row">
                <div class="col-10">
                    <div class="user-list">
                        <label for="ftitle">Offices <a href="add_office.php"><i class="fa fa-plus"></i></a></label>


                        <hr>

                        <?php
                        $sql = "SELECT * FROM offices";
                        $result = $conn->query($sql);
                        if (!$result) {
                            die("Invalid Query: " . $conn->errorInfo()[2]);
                        }
                        echo "<table>
                        <tr>
                            <th>Offices ID</th>
                            <th>Address</th>
                            <th>Action</th>
                      
                        </tr>";

                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                            echo "<tr>
                            <td>{$row['office_id']}</td>
                            <td>{$row['office_address']}</td>
                         
                            <td>
                                <a href=\"edit_user.php?office_id={$row['office_id']}\"><i class='fa fa-edit'></i></a>
                                <a href=\"delete_office.php?office_id= {$row['office_id']}\"><i class='fa fa-trash'></i></a>
                            </td>
                        </tr>";
                        }

                        echo "</table>";
                        ?>

                    </div>
                </div>
            </div>

        </form>
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
</style>
<script src="../js/tab.js"></script>
<?php require('../footer.php') ?>