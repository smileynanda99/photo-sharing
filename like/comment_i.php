<?php
  session_start();
  $_SESSION['message']="<div class='chip center green white-text' >
  Please Login From A Valid Account for Comment</div>";
  header("Location:../login.php");  
?> 