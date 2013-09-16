<?php 

session_start();
require_once('SalaryModel.php');
require_once('EmployeeModel.php');
$sa= new SalaryModel();
$result = $sa->select_all();
$token = $_SESSION['token'] =sha1(uniqid(rand(),true));
?> <table>
<tr>
<td> ID </td>
<td> employee_code </td>
<td> year </td>
<td> month </td>
<td> payment </td>
<td>created</td>
<td>modified</td>
<td></td>
<td></td>
</tr>
<?php foreach( $result as $data )
{ ?>
<tr>
<td> <?php echo $data['id'] ?> </td>
<td> <?php echo $data['employee_code'] ?> </td>
<td> <?php echo $data['year'] ?> </td>
<td> <?php echo $data['month'] ?> </td>
<td> <?php echo $data['payment'] ?> </td>
<td> <?php echo $data['created'] ?> </td>
<td> <?php echo $data['modified'] ?> </td>
<td> <a href='selects.php?id=<?php echo $data['id'] ?>'>Update</a></td>
<td> <form action="deletes.php/?id=<?php echo $data['id']; ?>" method = "POST"> 
<button><a href='deletes.php'>Delete</a></button>
 <input type='hidden' name='token' value="<?php echo $token;?>" />
</form></td>
</tr>
<?php } ?>
</table>
<a href='inserts.php'><strong>New Salary</strong></a>