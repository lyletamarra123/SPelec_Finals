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

                        <h3 class="user-list-header">User List </h3><i class="fa fa-plus"></i>
                        <hr>

                        <ul>
                            <li>
                                Rolly Barinan
                                <div class="icons">
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash"></i>
                                </div>
                            </li>
                            <li>
                                Christaian Verallo
                                <div class="icons">
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash"></i>
                                </div>
                            </li>

                            <li>
                                Denverth Larida
                                <div class="icons">
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash"></i>
                                </div>
                            </li>

                            <li>
                                Lyle Tammara
                                <div class="icons">
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash"></i>
                                </div>
                            </li>
                            <li>
                                Roderick Bandallan
                                <div class="icons">
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash"></i>
                                </div>
                            </li>
                            <li>
                                Josephine Petralba
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