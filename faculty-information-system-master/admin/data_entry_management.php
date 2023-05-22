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
    <div class="tab center">
        <button class="tablinks" onclick="openTab(event, 'Add')" id="defaultOpen">Department</button>
        <button class="tablinks" onclick="openTab(event, 'Course')">Courses</button>
        <button class="tablinks" onclick="openTab(event, 'Publication')">Publications </button>
    </div>
    <div id="Add" class="tabcontent">
        <form action=">" method="post">
            <div class="row">
                <div class="col-10">
                    <div class="user-list">
                        <label for="ftitle"><a href="add_department.php"><i class="fa fa-plus"></i>Add a Department</a></label>
                        <hr>
                        <?php
                        $sql = "SELECT * FROM department";
                        $result = $conn->query($sql);
                        if (!$result) {
                            die("Invalid Query: " . $conn->errorInfo()[2]);
                        }
                        echo "<table>
                        <tr>
                            <th>Department Code</th>
                            <th>Department Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Location</th>
                            <th>Action</th>
                        </tr>";

                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                            echo "<tr>
                            <td>{$row['DepartmentCode']}</td>
                            <td>{$row['DepartmentName']}</td>
                            <td>{$row['Email']}</td>
                            <td>{$row['Phone']}</td>
                            <td>{$row['Location']}</td>
                            <td>
                                <a href=\"update_department.php?DepartmentCode={$row['DepartmentCode']}\"><i class='fa fa-edit'></i></a>
                                <a href=\"delete_department.php?DepartmentCode={$row['DepartmentCode']}\"><i class='fa fa-trash'></i></a>
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
                        <label for="ftitle"><a href="add_course.php"><i class="fa fa-plus"></i>Add a Course</a></label>
                        <hr>
                        <?php
                        $sql = "SELECT * FROM courses";
                        $result = $conn->query($sql);
                        if (!$result) {
                            die("Invalid Query: " . $conn->errorInfo()[2]);
                        }
                        echo "<table>
                        <tr>
                            <th>Course Code</th>
                            <th>Course Name</th>
                            <th>Faculty Name</th>
                            <th>Department</th>
                            <th>Action</th>
                        </tr>";

                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                            echo "<tr>
                            <td>{$row['CourseCode']}</td>
                            <td>{$row['CourseName']}</td>
                            <td>{$row['FacultyName']}</td>
                            <td>{$row['Department']}</td>                                           
                            <td>
                                <a href=\"update_course.php?CourseCode={$row['CourseCode']}\"><i class='fa fa-edit'></i></a>
                                <a href=\"delete_course.php?CourseCode={$row['CourseCode']}\"><i class='fa fa-trash'></i></a>
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
                        <label for="ftitle"><a href="add_publication.php"><i class="fa fa-plus"></i>Add a Publication</a></label>
                        <hr>
                        <?php
                        $sql = "SELECT * FROM publications";
                        $result = $conn->query($sql);
                        if (!$result) {
                            die("Invalid Query: " . $conn->errorInfo()[2]);
                        }
                        echo "<table>
                        <tr>
                            <th>Title</th>
                            <th>Publication Type</th>
                            <th>Publication Date</th>
                            <th>Author</th>
                            <th>Author Type</th>
                            <th>Action</th>
                      
                        </tr>";

                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                            echo "<tr>
                            <td>{$row['Title']}</td>
                            <td>{$row['PublicationType']}</td>
                            <td>{$row['PublicationDate']}</td>
                            <td>{$row['Author']}</td>
                            <td>{$row['AuthorType']}</td>                                                                
                            <td>
                                <a href=\"update_publication.php?Title={$row['Title']}\"><i class='fa fa-edit'></i></a>
                                <a href=\"delete_publication.php?Title={$row['Title']}\"><i class='fa fa-trash'></i></a>
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