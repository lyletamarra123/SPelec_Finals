<?php 
require('header.php');

if(isset($_SESSION['username'])){
}else{
    header("Location: signin.php");
}

include('sidebar.php');
?>
<div class="row">
    <div class="col-2">
        <h2>Welcom Admin</h2>
        <p>Please contact web master immediately if anything went wrong.<br>
        <br>
        Email : <a href="mailto:webmaster@kln.ac.lk">webmasterlyle&rolly@gmail.com</a>
        <br>
        Tel : 033 22990901
        <br>
        Fax : 033 22990904</p>
    </div>
</div>
<style>
    .row button{
        width:100%;
        border:0;
        background:#eee;
        padding:5%;
        margin:1%;
        cursor:pointer;
        font-size:1em;
    }
    .row button:hover{
        background:#ddd;
    }
    .card-panel {
        background: #fff;
        border: 4px solid #cfd8dc;
        margin: 1%;
        display: inline-block;
        text-align: center;
        width: 47%;
        padding: 2%;
        position: relative;
        overflow:hidden;
        z-index:1;
        color:#fff;
    }
    .card-panel .fa {
        position: static;
        display:block;
        margin-bottom:10px;
        font-size: 6em;
        z-index:-1;
        margin-left:-100%;
    }
    .card-panel h2 {
        margin: -1em 0 0;
        font-size: 5em;
    }
    .courses{
        background-color:#FFCA28;
        border-color:#FFCA28;
    }
    .students{
        background-color:#ef5350;
        border-color:#ef5350;
    }
    .subjects{
        background-color:#66BB6A;
        border-color:#66BB6A;
    }
    .faqs{
        background-color:#5C6BC0;
        border-color:#5C6BC0;
    }
   
</style>
<?php
    require('footer.php');
?>