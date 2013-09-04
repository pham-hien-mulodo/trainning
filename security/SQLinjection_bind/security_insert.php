<?php
$mysqli = new mysqli('host', 'user', 'password', 'database');
$stmt = $mysqli->prepare("INSERT INTO employee VALUES (?,?,?,?)");
$stmt->bind_param('ssss', $name, $title, $created, $modified);
$stmt->execute();
$stmt = $mysqli->prepare("UPDATE employee SET name = ?, title = ?, created = ? , modified = ? WHERE id= ? ");
$stmt->bind_param('ssssi', $name, $title, $created, $modified, $id);
$stmt->execute();
