
<table>
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
<td> <form action="index.php?uri=employee/selectById&param[id]=<?php echo $data['id']; ?>" method = "POST"> 
 <input type='submit' name='Update' value='Update' /> 
<input type='hidden' name='token' value="<?php echo $token;?>" />
</form></td>
<td>  <form action="index.php?uri=employee/delete&param[id]=<?php echo $data['id']; ?>" method = "POST"> 
 <input type='submit' name='Delete' value='delete' /> 
<input type='hidden' name='token' value="<?php echo $token;?>" />
</form></td>
</tr>
<?php } ?>
</table>
 <form action="index.php?uri=employee/insert" method = "POST"> 
 <input type='submit' name='Insert' value='insert' /> 
<input type='hidden' name='token' value="<?php echo $token;?>" />
</form>
