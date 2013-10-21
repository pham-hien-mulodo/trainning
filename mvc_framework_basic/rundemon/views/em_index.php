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
<td> <a href='index.php?uri=employee/selectById&param[token]=<?php echo $token; ?>&param[id]=<?php echo $data['id'] ?>'>Update</a></td>
<td> <form action="index.php?uri=employee/delete?id=<?php echo $data['id']; ?>" method = "POST"> 
<button><a href='index.php?uri=employee/delete&param[token]=<?php echo $token; ?>&param[id]=<?php echo $data['id'] ?>'>Delete</a></button>
 <input type='hidden' name='token' value="<?php echo $token;?>" />
</form></td>
</tr>
<?php } ?>
</table>
<a href='index.php?uri=employee/insert&param[token]=<?php echo $token; ?>'><strong>New employee</strong></a>


