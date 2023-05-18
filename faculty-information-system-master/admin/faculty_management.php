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

    <div class="user-list">

        <h3 class="user-list-header">List of all Faculty Members </h3><i class="fa fa-plus"></i>
<hr>

        <ul>
            <li>
              Mr. Gene P abello
                <div class="icons">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash"></i>
                </div>
            </li>
            <li>
               Mrs. Josephine Petralba
                <div class="icons">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash"></i>
                </div>
            </li>

            <li>
               Mr. Roderick Bandalan
                <div class="icons">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash"></i>
                </div>
            </li>

            <li>
               Mrs. Marisa
                <div class="icons">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash"></i>
                </div>
            </li>
            <li>
                Mrs. Lorna Miro
                <div class="icons">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash"></i>
                </div>
            </li>
            <li>
                Mr. Geofrey Gudio
                <div class="icons">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash"></i>
                </div>
            </li>

        </ul>

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