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
    // if (isset($_POST['submit'])) {
    //     if($_POST['operation'] === 'add'){
    //         $sql="INSERT INTO faq (faqHeading,faqContent) VALUES (:ftitle,:fdesc)";
    //         $stmt = $conn->prepare($sql);
    //         $stmt->bindValue(':ftitle', $_POST['ftitle']);
    //         $stmt->bindValue(':fdesc', $_POST['fdesc']);

    //         if ($stmt->execute()) {
    //             echo "<div class='alert success'>New FAQ added successfully</div>";
    //             ob_start();
    //         } else {
    //             echo "<div class='alert info'>Error: " . $stmt->errorInfo()[2] . "</div>";
    //         }
    //     }elseif($_POST['operation'] === 'change'){

    //     }
    // }
    ?>

    <div class="box">
        <form action=">" method="post">
            <div class="row">
                <div class="col-8">

                    <div class="user-list">

                        <h3 class="user-list-header">Add Course Section </h3>
                        <a href="data_entry_management.php">
                            <li><i class="fa fa-arrow-right">Back </i></li>
                        </a>
                        <hr>
                        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                            <div class="row">
                                <div class="col-8">
                                    <label for="courseID">Course ID</label>
                                    <input class="form-input" type="text" id="courseID" name="courseID" placeholder="..." maxlength="256" required>

                                    <label for="courseName">Course Name</label>
                                    <input class="form-input" type="text" id="courseName" name="courseName" placeholder="..." maxlength="256" required>

                                    <label for="department">Department</label>
                                    <select class="form-input" id="department" name="department" required>
                                        <option value="department1"> School of Arts and Sciences </option>
                                        <option value="department2"> School of Business and Management </option>
                                        <option value="department3"> School of Computer Studies 3</option>
                                        <!-- Add more departments as needed -->
                                    </select>
                                </div>
                            </div>

                            <input type="hidden" name="operation" value="add">
                            <input class="btn" type="submit" name="submit" value="Add to Database">
                        </form>
                    </div>
                    <!-- <label for="fdesc">FAQ Description *</label>
                    <textarea rows="10" class='form-input' id="fdesc" name="fdesc" placeholder="..." required></textarea> -->
                </div>
            </div>
            <!-- <input type="hidden" name='operation' value='add'> -->
            <!-- <input class="btn" type="submit" name="submit" value="Add to database"> -->
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

    .box {
        padding-bottom: 30%;
    }
</style>
<script src="../js/tab.js"></script>
<?php require('../footer.php') ?>