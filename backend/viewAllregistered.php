<?php
require('../includes/function.php');
require('../config.php');
include_once('../includes/adminHeader.php'); 
?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>View All </title>
</head>
<body>
<div class="container"><font color = 'green'>
<table width="1100" border="1px"  class="table table-borderd table-hover" align="center">
   <tr align="center" bgcolor="silver"> <td colspan=12><b>
   <div class="container"><font color = 'green'><h2>View All Registered graduates and their Certificate details here!</h2></a></div>
   
   </b></td></tr>
   <tr bgcolor="silver"> 
   <td><b>SN</b></td>
	  <td><b>#</b></td>
      <td><b>Full Name</b></td>
      <td><b>Gender</b></td>
	  <td><b>Matric No</b></td>
      <td><b>Department </b></td>
     <td><b>Degree/Class</b></td>
     <td><b>Year</b></td>
     <td><b>Uploaded On </b></td>
	  <td colspan = "2"><b>Action</b></td>
   </tr></a>

   <?php
$viewAllColl= $db->users->aggregate([
	['$lookup' => ['from' => "certificates",
		'localField' => "id",
		'foreignField' => "id", 
		'as' => "viewAll"]],
	['$unwind'=>'$viewAll'],
   ['$project'=>['id'=>1,'name'=>1,'gender'=>1,'matno'=>1,
   'viewAll.department'=>1,'viewAll.degree'=>1, 
    'viewAll.date_uploaded'=>1, 'viewAll.date_of_graduation'=>1
    ]]]);
    $sn = 0;
foreach($viewAllColl as $All){
   ?>
   <?php
   
    $sn++;
       echo "<tr>";
       echo "<td>".$sn."</td>";
		 echo "<td>".$All->id."</td>";
       echo "<td>".$All->name."</td>";
       echo "<td>".$All->gender."</td>";
		 echo "<td>".$All->matno."</td>";
		 echo "<td>".$All->viewAll->department."</td>";
       echo "<td>".$All->viewAll->degree."</td>";
       echo "<td>".$All->viewAll->date_of_graduation."</td>";
       echo "<td>".$All->viewAll->date_uploaded."</td>";
		 echo "<td>";
       echo "<a href='editAll.php?id=".$All->id." 'class='btn btn-success'>Edit </a>";
       echo "<td>";
       echo "<a href='delete.php?id=".$All->id." 'class='btn btn-danger'>Delete </a>";
       "</td>";
       echo "</tr>";
      	?>
   <?php   
      }
      
   ?>
					</div> 
					</table>
				</div>  
        	</div>
		</body>
	</html>