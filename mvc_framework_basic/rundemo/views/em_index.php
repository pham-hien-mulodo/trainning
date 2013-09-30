<?php 
ob_start();
session_start();
require_once('../model/salaryModel.php');
require_once('../model/employeeModel.php');
$em = new EmployeeModel();
$result = $em->select_all();
$token = $_SESSION['token'] =sha1(uniqid(rand(),true));
?> <table>
<tr>
<td> ID </td>
<td> Name </td>
<td> Title </td>
<td> Create </td>
<td> Modify </td>
<td></td>
<td></td>
</tr>
<?php foreach( $result as $data )
{ ?>
<tr>
<td> <?php echo $data['id'] ?> </td>
<td> <?php echo $data['name'] ?> </td>
<td> <?php echo $data['title'] ?> </td>
<td> <?php echo $data['created'] ?> </td>
<td> <?php echo $data['modified'] ?> </td>
<td> <form action="em_update.php/?id=<?php echo $data['id']; ?>" method = "POST"> 
<button><a href='em_update.php'>Update</a></button>
 <input type='hidden' name='token' value="<?php echo $token;?>" />
</form></td>
<td> <form action="em_delete.php/?id=<?php echo $data['id']; ?>" method = "POST"> 
<button><a href='em_delete.php'>Delete</a></button>
 <input type='hidden' name='token' value="<?php echo $token;?>" />
</form>
</td>

</tr>
<?php } ?>
</table>
<a href='insert.php'><strong>New Employee</strong></a>