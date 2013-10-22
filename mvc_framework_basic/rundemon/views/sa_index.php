<?php 


?> 

<table>
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
<td> <form action="index.php?uri=salary/selectById&param[id]=<?php echo $data['id']; ?>" method = "POST"> 
 <input type='submit' name='Update' value='Update' /> 
<input type='hidden' name='token' value="<?php echo $token;?>" />
</form></td>
<td>  <form action="index.php?uri=salary/delete&param[id]=<?php echo $data['id']; ?>" method = "POST"> 
 <input type='submit' name='Delete' value='delete' /> 
<input type='hidden' name='token' value="<?php echo $token;?>" />
</form></td>
</tr>
<?php } ?>
</table>
<form action="index.php?uri=salary/insert" method = "POST"> 
 <input type='submit' name='Insert' value='insert' /> 
<input type='hidden' name='token' value="<?php echo $token;?>" />
</form>