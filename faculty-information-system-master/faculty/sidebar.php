

<div class="col-2 menu">
	<ul>
		<a href="profile.php"><li><i class="fa fa-user"></i> Profile</li></a>
		<a href="work_history.php"><li><i class="fa fa-briefcase"></i>Work History</li></a>
		<a href="publication.php"><li><i class="fa fa-book"></i>Publications</li></a>
		<a href="degrees.php"><li><i class="fa fa-graduation-cap"></i>Degrees Earned</li></a>
		<a href="awards.php"><li><i class="fa fa-award"></i>Grants/Awards</li></a>
		<a href="courses.php"><li><i class="fa fa-chalkboard-teacher"></i>Courses Taught</li></a>
		<a href="departments.php"><li><i class="fa fa-building"></i>Departments</li></a>
		<a href="help.php"><li><i class="fa fa-question-circle"></i>Help</li></a>
		<a href="includes/signout.php"><li><i class="fa fa-sign-out-alt"></i>Logout</li></a>
	</ul>
</div>

<style>
.menu ul {
	list-style-type: none;
	margin: 0;
	padding: 0
}

.menu li {
	cursor: pointer;
	padding: 1em;
	margin-bottom: .8em;
	background-color: #CFD8DC;
	box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
	-webkit-transition: all .25s ease;
	-moz-transition: all .25s ease;
	-ms-transition: all .25s ease;
	-o-transition: all .25s ease;
	transition: all .25s ease;
}

.menu li:hover {
	background-color: #680000;
	color: #fff;
}

.menu a {
	color: #333;
	padding: 0;
	margin: 0;
}

.menu .fa {
	margin: 0 1em;
}
@media only screen and (max-width:768px) {
	.menu{
		margin: 0;
		padding: 0;
	}
	.menu li {
		width: 18%;
		display: inline-block;
		margin: 2% .5%;
		text-align: center;
		font-size: 12px;
	}

	.menu .fa {
		margin: 0 1em;
		display: block;
		margin: .5em;
		font-size: 2em;
	}

	.menu {
		text-align: center;
	}
}
</style>