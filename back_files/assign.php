<?php
if (isset($_POST['assign']))
{
    $name = $_POST['name'];
    $assign = $_POST['assigned'];
    $mokeup = addslashes($_POST['mokeup']);
    $startDate = $_POST['startDate'];
    $dueDate = $_POST['dueDate'];
    $description = addslashes($_POST['description']);

    $assign = mysqli_query($con, "INSERT INTO `project` (`assigned`, `start_date`, `due_date`, `mokeup`, `name`, `description`, `status`)
     VALUES 
     ('$assign', '$startDate', '$dueDate', '$mokeup', '$name', '$description', 'new')");
     if($assign)
     echo"assigned";
}