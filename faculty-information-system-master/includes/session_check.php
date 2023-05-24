<?php

if (isset($_SESSION['sno'])) {
} elseif ($_SESSION['stno']) {
	header("Location: admin/dashboard.php");
} elseif ($_SESSION['username']) {
	header("Location: faculty/dashboard.php");
} else {
	session_unset();
	session_destroy();
	header("Location: index.php");
}
