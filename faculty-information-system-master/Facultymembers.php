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
		<h1>Faculty Members</h1>
		<div class="row">
        <input type="text" id="searchBar" oninput="getFaculty(this.value)" placeholder="Search by Faculty Name" title="Type a faculty name">
        <table id="facultyList">
            <tr>
                <th>Faculty ID</th>
                <th>Faculty Name</th>
                <th>Position</th>
				<th>Department</th>
				<th>Email</th>
				<th>PhoneNumber</th>
            </tr>
            <?php 
            $sql = "SELECT * FROM faculty ORDER BY RAND() LIMIT 4";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            $rowCount = $stmt->rowCount();
            if ($rowCount > 0) {
                foreach ($result as $row) {
                    echo "<tr>";
                    echo "<td>" . $row['FacultyID'] . "</td>";
                    echo "<td>" . $row['FacultyName'] . "</td>";
                    echo "<td>" . $row['Position'] . "</td>";
					echo "<td>" . $row['Department'] . "</td>";
					echo "<td>" . $row['Email'] . "</td>";
					echo "<td>" . $row['PhoneNumber'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No faculty members found.</td></tr>";
            }
            ?>
        </table>  
		</div>
	</div>
</div>

<script>
function getFaculty(str) {
    if (window.XMLHttpRequest) {
        // code for modern browsers
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for old IE versions
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("facultyList").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "modules/search-faculty.php?q=" + str, true);
    xmlhttp.send();
}
</script>
<?php require('footer.php'); ?>

