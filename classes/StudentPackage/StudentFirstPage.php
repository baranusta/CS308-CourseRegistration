<?php
session_start();
	if(!isset($_SESSION['userName'])){
		echo 'lolo';
		header("location:../../main_login.php");
	}
	else{
	}
?>



<a href="..\CoursePackage\CourseFilterPage.php" class="submenulinktext2 " onmouseover="window.status='New Personal Information'; return true" onmouseout="window.status=''; return true" onfocus="window.status='New Personal Information'; return true" onblur="window.status=''; return true">
<img src="https://suisimg.sabanciuniv.edu/images/sabanci_bullet_red.gif" class="headerImg" title="" name="sabanci_bullet_red" hspace="0" vspace="0" border="0" height="15" width="7"></a>
<a href="..\CoursePackage\CourseFilterPage.php" class="submenulinktext2 " onmouseover="window.status='New Personal Information'; return true" onmouseout="window.status=''; return true" onfocus="window.status='New Personal Information'; return true" onblur="window.status=''; return true"><font size="3" color="black"><b>Personal Information</b></font></a>
<br>
<a href="..\CoursePackage\CourseFilterPage.php" class="submenulinktext2 " onmouseover="window.status='New Personal Information'; return true" onmouseout="window.status=''; return true" onfocus="window.status='New Personal Information'; return true" onblur="window.status=''; return true">
<img src="https://suisimg.sabanciuniv.edu/images/sabanci_bullet_red.gif" class="headerImg" title="" name="sabanci_bullet_red" hspace="0" vspace="0" border="0" height="15" width="7"></a>
<a href="..\CoursePackage\CourseFilterPage.php" class="submenulinktext2 " onmouseover="window.status='New Personal Information'; return true" onmouseout="window.status=''; return true" onfocus="window.status='New Personal Information'; return true" onblur="window.status=''; return true"><font size="3" color="black"><b>Add Course</b></font></a>
<br>
<a href="..\CoursePackage\CourseFilterPage.php" class="submenulinktext2 " onmouseover="window.status='New Personal Information'; return true" onmouseout="window.status=''; return true" onfocus="window.status='New Personal Information'; return true" onblur="window.status=''; return true">
<img src="https://suisimg.sabanciuniv.edu/images/sabanci_bullet_red.gif" class="headerImg" title="" name="sabanci_bullet_red" hspace="0" vspace="0" border="0" height="15" width="7"></a>
<a href="..\CoursePackage\CourseFilterPage.php" class="submenulinktext2 " onmouseover="window.status='New Personal Information'; return true" onmouseout="window.status=''; return true" onfocus="window.status='New Personal Information'; return true" onblur="window.status=''; return true"><font size="3" color="black"><b>Drop Course</b></font></a>
<br>