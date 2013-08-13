<?php

require_once 'connectdb.php';

function insert($data)
{
    $sql = "INSERT INTO employee ('name', 'title', 'created', 'modified')
            VALUES('".$data['name']."', ".$data['title'].", ".$data['created'].", ".$data['modified'].")";
 
    $result = mysql_query($sql);
 
    return $result;
}
}
function update($data = array(), $id = 0)
{

    $sql = "UPDATE `group` SET
            `name` = '".$data['name']."', status = ".$data['status'].", modified = ".$data['modified']."
            WHERE id = $id";
         
    $result = mysql_query($sql);
 
    return $result;
}
}
function delete($id)
{
    $sql = "DELETE FROM `employee`
            WHERE `id` = $id";
     
    return mysql_query($sql);
}
function select_by_id($id)
{
$sql = "SELECT * FROM 'employee' WHERE id=$id";
    $query = mysql_query($sql);
 
    return $query;
}
