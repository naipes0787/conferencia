<?php
  $conn = new mysqli('localhost', 'root', '', 'conferencia');
  if($conn->connect_error){
    echo $error -> $conn->$connect_error;
  }
?>
