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
		<h1>Publications</h1>
		<div class="row">
        <input type="text" id="searchBar" oninput="getPublications(this.value)" placeholder="Search by Title, PublicationType, or Author" title="Type a faculty name">
        <table id="publicationList">
            <tr>
                <th>Publication ID</th>
				<th>Title</th>
                <th>Publication Type</th>
				<th>Date Published</th>
				<th>Author</th>
            </tr>
            <?php 
			include_once('includes/info_db_connect.php');
			require_once('faculty/class/Publications.php');
			$db = new DBConnectInfo();
			$conn = $db->getConnection();
			$title = null;
			$publicationType = null;
			$publicationDate = null;
			$facultyId = null;

			$publication = new Publications($title, $publicationType, $publicationDate, $facultyId);
			$publication->getPublicationsList($conn);

            ?>
        </table>  
		</div>
	</div>
</div>

<script>
function getPublications(str) {
    if (window.XMLHttpRequest) {
        // code for modern browsers
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for old IE versions
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("publicationList").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "modules/search-publications.php?q=" + str, true);
    xmlhttp.send();
}
</script>
<?php require('footer.php'); ?>

