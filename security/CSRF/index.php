<?php 
session_start();
require_once('SalaryModel.php');
require_once('EmployeeModel.php');
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
<td> <a href='select.php?id=<?php echo $data['id'] ?>'>Update</a></td>
<td>  <a href='delete.php?id=<?php echo $data['id'] ?>'>Delete</a><form method = "POST"><input type='hidden' name='token' value="<?php echo $token;?>" /></form>
</td>

</tr>
<?php } ?>
</table>
<a href='insert.php'><strong>New Employee</strong></a>