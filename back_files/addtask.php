
<?php
if (isset($_POST["input_name"]) && is_array($_POST["input_name"])){ 
 $id = $_POST['id'];
  $input_name = $_POST["input_name"]; 
  foreach($input_name as $field_value){
    $insert = mysqli_query($con, "INSERT INTO `tasks` (`pId`,`name`,`status`) VALUES('$id','$field_value','new')");
  }
}
?>
<section class="post">

<h2> Tasks</h2>
<p class="ttle">Tasks for this project</p>
<div class="container">
    <section class="post">
        <?php
            $listTask = mysqli_query($con, "SELECT * FROM `tasks` WHERE `pId` = '$id'");
            while ($task = mysqli_fetch_array($listTask))
            {
                echo $task['name']."<br>";
            }
        ?>
    </section>
</div>
</section>