<?php
session_start();
	if(!isset($_SESSION['userName'])){
		header("location:../../main_login.php");
	}
	else{
	}
?>



<a href="SeeSchedulePage.php" class="submenulinktext2 " onmouseover="window.status='New Personal Information'; return true" onmouseout="window.status=''; return true" onfocus="window.status='New Personal Information'; return true" onblur="window.status=''; return true">
<img src="https://suisimg.sabanciuniv.edu/images/sabanci_bullet_red.gif" class="headerImg" title="" name="sabanci_bullet_red" hspace="0" vspace="0" border="0" height="15" width="7"></a>
<a href="SeeSchedulePage.php" class="submenulinktext2 " onmouseover="window.status='New Personal Information'; return true" onmouseout="window.status=''; return true" onfocus="window.status='New Personal Information'; return true" onblur="window.status=''; return true"><font size="3" color="black"><b>See Schedule</b></font></a>
<br>
<a href="StudentAddDropPage.php" class="submenulinktext2 " onmouseover="window.status='New Personal Information'; return true" onmouseout="window.status=''; return true" onfocus="window.status='New Personal Information'; return true" onblur="window.status=''; return true">
<img src="https://suisimg.sabanciuniv.edu/images/sabanci_bullet_red.gif" class="headerImg" title="" name="sabanci_bullet_red" hspace="0" vspace="0" border="0" height="15" width="7"></a>
<a href="StudentAddDropPage.php" class="submenulinktext2 " onmouseover="window.status='New Personal Information'; return true" onmouseout="window.status=''; return true" onfocus="window.status='New Personal Information'; return true" onblur="window.status=''; return true"><font size="3" color="black"><b>Add/Drop Course</b></font></a>
<br>