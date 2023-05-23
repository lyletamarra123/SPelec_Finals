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
    </div>
    <div id="Add" class="tabcontent">
        <form action=">" method="post">
            <div class="row">
                <div class="col-10">
                    <div class="user-list">
                        <label for="ftitle"><a href="add_department.php"><i class="fa fa-plus"></i>Add a Department</a></label>
                        <hr>
                        <?php
                        require_once('../OOPClasses/Department.php');
                        $db = new DBConnect();
                        $conn = $db->getConnection();
                        $DepartmentManager = new DepartmentSearch($conn);
                        $DepartmentManager->displayDepartments();
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
                        require_once('../OOPClasses/Course.php');
                        $db = new DBConnect();
                        $conn = $db->getConnection();
                        $CourseManager = new CourseSearch($conn);
                        $CourseManager->displayCourses();
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