<?php 
ob_start();
session_start();
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
<td> <form action="index.php?rt=employee/update/?id=<?php echo $data['id']; ?>" method = "POST"> 
<button><a href='index.php?rt=employee/em_update'>Update</a></button>
 <input type='hidden' name='token' value="<?php echo $token;?>" />
</form></td>
<td> <form action="index.php?rt=employee/em_index.php/?id=<?php echo $data['id']; ?>" method = "POST"> 
<button><a href='index.php?rt=employee/delete'>Delete</a></button>
 <input type='hidden' name='token' value="<?php echo $token;?>" />
</form>
</td>
<td> <form action="em_selectById.php/?id=<?php echo $data['id']; ?>" method = "POST"> 
<button><a href='index.php?rt=employee/selectById'><strong>Detail</strong></a></button>
 <input type='hidden' name='token' value="<?php echo $token;?>" />
</form>
</td>
</tr>
<?php } ?>
</table>
<a href='index.php?rt=employee/insert'><strong>New Employee</strong></a>

