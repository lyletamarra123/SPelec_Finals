<?php require('header.php'); ?>
<style>
	#subjectList {
		border-collapse: collapse;
		width: 100%;
		border: 1px solid #ddd;
		font-size: 1em;
	}
	#subjectList th, #subjectList td {
		text-align: left;
		padding: 12px;
	}
	#subjectList tr {
		border-bottom: 1px solid #ddd;
	}
	#subjectList tr.header, #myTable tr:hover {
		background-color: #f1f1f1;
	}
	#subjectList td:first-child {
		width:30%;
	}
	.fa-file-download{
		float:right;
		font-size:1.5em;
	}
	@media only screen and (max-width:768px) {
		#subjectList td{
			display: block;
			padding-left: 40px;
		}
		#subjectList td:first-child{
			width:100%;
			padding-left: 20px;
			font-weight: bold;
			background-color: #ddd;
		}
	}
</style>
<div class="row">
	<?php require('sidebar.php'); ?>
	<div class="col-6">
		<h1>Courses taught by Faculty member</h1>
		<div class="row">
        <input type="text" id="searchBar" oninput="getCourses(this.value)" placeholder="Search by Course or Faculty Name" title="Type a faculty name">
        <table id="coursesList">
            <tr>
                <th>Course Code</th>
				<th>Course Name</th>
                <th>Taught By</th>
				<th>Department</th>
            </tr>
            <?php 
            $sql = "SELECT * FROM courses ORDER BY RAND() LIMIT 4";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            $rowCount = $stmt->rowCount();
            if ($rowCount > 0) {
                foreach ($result as $row) {
                    echo "<tr>";
                    echo "<td>" . $row['CourseCode'] . "</td>";
                    echo "<td>" . $row['CourseName'] . "</td>";
                    echo "<td>" . $row['FacultyName'] . "</td>";
					echo "<td>" . $row['Department'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No Course or faculty member found.</td></tr>";
            }
            ?>
        </table>  
		</div>
	</div>
</div>

<script>
function getCourses(str) {
    if (window.XMLHttpRequest) {
        // code for modern browsers
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for old IE versions
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("coursesList").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "modules/search-courses.php?q=" + str, true);
    xmlhttp.send();
}
</script>
<?php require('footer.php'); ?>

