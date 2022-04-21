<?php
if (isset($_POST['start']))
{
    $id = $_POST['id'];
    $lastUpdate = date('Y-m-d');
    $check = mysqli_query($con, "SELECT * FROM `project` WHERE `pId` = '$id' AND `status` = 'new'");
    $nmb_of_result = mysqli_num_rows($check);
    if($nmb_of_result > 0)
    {
        $update = mysqli_query($con, "UPDATE `project` SET `status` = 'progress', `last_update`='$lastUpdate' WHERE `pId` = '$id'");
        if($update){
                echo "project have started";
            
        }
    }
    
}