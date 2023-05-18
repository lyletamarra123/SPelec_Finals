<?php require('header.php');
if (isset($_SESSION['stno'])) {
} else {
    header("Location: login.php");
}
include('sidebar.php');
ob_start();
?>

<div class='col-4'>

    <?php
    if (isset($_POST['submit'])) {
        if ($_POST['operation'] === 'add') {
            $sql = "INSERT INTO faq (faqHeading,faqContent) VALUES (:ftitle,:fdesc)";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':ftitle', $_POST['ftitle']);
            $stmt->bindValue(':fdesc', $_POST['fdesc']);

            if ($stmt->execute()) {
                echo "<div class='alert success'>New FAQ added successfully</div>";
                ob_start();
            } else {
                echo "<div class='alert info'>Error: " . $stmt->errorInfo()[2] . "</div>";
            }
        } elseif ($_POST['operation'] === 'change') {
        }
    }
    ?>

    <div class="tab center">
        <button class="tablinks" onclick="openTab(event, 'Add')" id="defaultOpen">Department</button>
        <button class="tablinks" onclick="openTab(event, 'Course')">Courses Offerd</button>
        <button class="tablinks" onclick="openTab(event, 'Publication')">Publication </button>
        <button class="tablinks" onclick="openTab(event, 'Jobs')">Jobs </button>

    </div>

    <div id="Add" class="tabcontent">
        <form action=">" method="post">
            <div class="row">
                <div class="col-8">


                    <div class="user-list">
                        <label for="ftitle">All Department <i class="fa fa-plus"></i></label>

                        <hr>

                        <ul>
                            <li>
                                School of Arts and Sciences
                                <div class="icons">
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash"></i>
                                </div>
                            </li>
                            <li>
                                School of Business and Management
                                <div class="icons">
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash"></i>
                                </div>
                            </li>

                            <li>
                                School of Computer Studies
                                <div class="icons">
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash"></i>
                                </div>
                            </li>

                            <li>
                                School of Engineering
                                <div class="icons">
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash"></i>
                                </div>
                            </li>


                        </ul>

                    </div>

                    <!-- <label for="fdesc">FAQ Description *</label>
                    <textarea rows="10" class='form-input' id="fdesc" name="fdesc" placeholder="..." required></textarea> -->
                </div>
            </div>
            <!-- <input type="hidden" name='operation' value='add'> -->
            <!-- <input class="btn" type="submit" name="submit" value="Add to Database"> -->
        </form>
    </div>

    <div id="Course" class="tabcontent">
        <form action=">" method="post">
            <div class="row">
                <div class="col-8">


                    <div class="user-list">
                        <label for="ftitle">All Courses <i class="fa fa-plus"></i></label>

                        <hr>

                        <ul>
                            <li>
                                BA in COMMUNICATION
                                <div class="icons">
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash"></i>
                                </div>
                            </li>
                            <li>
                                BA in MARKETING COMMUNICATION
                                <div class="icons">
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash"></i>
                                </div>
                            </li>

                            <li>
                                BA in JOURNALISM
                                <div class="icons">
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash"></i>
                                </div>
                            </li>

                            <li>
                                BA in ENGLISH LANGUAGE STUDIES
                                <div class="icons">
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash"></i>
                                </div>
                            </li>
                            <li>
                                BS in ACCOUNTANCY
                                <div class="icons">
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash"></i>
                                </div>
                            </li>
                            <li>
                                BS in MANAGEMENT ACCOUNTING
                                <div class="icons">
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash"></i>
                                </div>
                            </li>
                            <li>
                                BS COMPUTER SCIENCE
                                <div class="icons">
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash"></i>
                                </div>
                            </li>

                            <li>
                                BS INFORMATION SYSTEMS
                                <div class="icons">
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash"></i>
                                </div>


                            </li>
                            <li>
                                BS INFORMATION TECHNOLOGY
                                <div class="icons">
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash"></i>
                                </div>
                            </li>



                        </ul>

                    </div>

                    <!-- <label for="fdesc">FAQ Description *</label>
                    <textarea rows="10" class='form-input' id="fdesc" name="fdesc" placeholder="..." required></textarea> -->
                </div>
            </div>
            <!-- <input type="hidden" name='operation' value='add'>
            <input class="btn" type="submit" name="submit" value="Add to Database"> -->
        </form>
    </div>

    <div id="Publication" class="tabcontent">
        <form action=">" method="post">
            <div class="row">
                <div class="col-8">
                    <div class="user-list">
                        <label for="ftitle">Books Publication <i class="fa fa-plus"></i></label>
                        <hr>
                        <ul>
                            <li>
                                FORWARD
                                <div class="icons">
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash"></i>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- <label for="fdesc">FAQ Description *</label>
                    <textarea rows="10" class='form-input' id="fdesc" name="fdesc" placeholder="..." required></textarea> -->
                </div>
            </div>
            <!-- <input type="hidden" name='operation' value='add'> -->
            <!-- <input class="btn" type="submit" name="submit" value="Add to database"> -->
        </form>
    </div>
    <div id="Jobs" class="tabcontent">
        <form action=">" method="post">
            <div class="row">
                <div class="col-8">
                    <div class="user-list">
                        <label for="ftitle">Job Type <i class="fa fa-plus"></i></label>
                        <hr>
                        <ul>
                            <li>
                                Professor
                                <div class="icons">
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash"></i>
                                </div>
                            </li>
                            <li>
                                Associate Professor
                                <div class="icons">
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash"></i>
                                </div>
                            </li>
                            <li>
                                Assistant Professor
                                <div class="icons">
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash"></i>
                                </div>
                            </li>
                            <li>
                                Lecturer
                                <div class="icons">
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash"></i>
                                </div>
                            </li>
                            <li>
                                Adjunct Professor
                                <div class="icons">
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash"></i>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- <label for="fdesc">FAQ Description *</label>
                    <textarea rows="10" class='form-input' id="fdesc" name="fdesc" placeholder="..." required></textarea> -->
                </div>
            </div>
            <!-- <input type="hidden" name='operation' value='add'> -->
            <!-- <input class="btn" type="submit" name="submit" value="Add to Database"> -->
        </form>

    </div>

</div>

<!-- <div class="col-2 notice">
    <h2><i class='fa fa-question-circle'></i> Notice</h2>
    <p>Please check twice before you submit.</p>
    <h2><i class="fa fa-link"></i> Quick Links</h2>
    <p>
    <ul>
        <li><a href="student.php">Add New Student</a></li>
        <li><a href="subject.php">Add New Subject</a></li>
        <li><a href="course.php">Add New Course</a></li>
    </ul>
    </p>
</div> -->

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