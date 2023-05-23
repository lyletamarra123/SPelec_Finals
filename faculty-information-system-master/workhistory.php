<?php 
	require('header.php'); 
?>
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
		<h1>Work History</h1>
		<div class="row">
        <input type="text" id="searchBar" oninput="getWorkHistory(this.value)" placeholder="Search by Faculty Name" title="Type a faculty name">
        <table id="workHistoryList">
            <tr>
                <th>Faculty Name</th>
				<th>Company Name</th>
                <th>Job Title</th>
				<th>Start Date</th>
				<th>End Date</th>
				<th>Description</th>
            </tr>
            <?php
			require('OOPClasses/Work.php');
			$db = new DBConnect();
			$conn = $db->getConnection();
            $workHistory = new WorkHistory($conn);
            $workHistory->getWorkHistory();
            ?>
        </table>  
		</div>
	</div>
</div>

<script>
function getWorkHistory(str) {
    if (window.XMLHttpRequest) {
        // code for modern browsers
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for old IE versions
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("workHistoryList").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "modules/search-work.php?q=" + str, true);
    xmlhttp.send();
}
</script>
<?php require('footer.php'); ?>

