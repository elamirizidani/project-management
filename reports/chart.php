<?php
// $con  = mysqli_connect("localhost","root","","igiheco_new_press");
//  if (!$con) {
//      # code...
//     echo "Problem in database connection! Contact administrator!" . mysqli_error();
//  }else{
//     $articles=0;$events=0;$activity =0;$idea =0;
//         $events = mysqli_query($con, "SELECT COUNT(`id_event`) as `event` FROM `events` WHERE `id_user` = '63'");
//         while($row = mysqli_fetch_array($events))
//         {
//             $event = $row['event'];
//         }

//         $articles = mysqli_query($con, "SELECT COUNT(`id_article`) as `articles` FROM `articles` WHERE `id_reporter` = '63'");
//         while($row = mysqli_fetch_array($articles))
//         {
//             $article = $row['articles'];
//         }

//         $activities = mysqli_query($con, "SELECT COUNT(`id_activity`) as `activities` FROM `activities` WHERE `activity_added_by` = '63'");
//         while($row = mysqli_fetch_array($activities))
//         {
//             $activity = $row['activities'];
//         }

//         $ideas = mysqli_query($con, "SELECT COUNT(`id_ideas`) as `ideas` FROM `ideas` WHERE `id_user` = '63'");
//         while($row = mysqli_fetch_array($ideas))
//         {
//             $idea = $row['ideas'];
//         }
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$users = $con->listOfUsers();
if(!empty($users))
{
    foreach ($users as $user) {
        if(($user['role'] != "developer") && ($user['role'] != "designer"))
            continue;
        $label [] = $user['username'];
        if($user['role'] == "developer")
            $tasks = $con->weeklyTasks("assigned",$user['uId']);
        else
            $tasks = $con->weeklyTasks("designer",$user['uId']);
        if(!empty($tasks))
            foreach ($tasks as $task) 
        $data []= $task['tasks'];
    }
}
        
//  }
 
 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Graph</title>
</head>

<body>
    <div style="width: -moz-fit-content;block-size: fit-content;text-align:center">
        <h2 class="page-header">Weekls Tasks </h2>
        <div>Developers </div>
        <canvas id="chartjs_bar"></canvas>
    </div>
</body>
<script src="//code.jquery.com/jquery-1.9.1.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script type="text/javascript">
var ctx = document.getElementById("chartjs_bar").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($label); ?>,
        datasets: [{
            backgroundColor: [
                "#5969ff",
                "#ff407b",
                "#25d5f2",
                "#ffc750",
                "#2ec551",
                "#7040fa",
                "#ff004e"
            ],
            data: <?php echo json_encode($data); ?>,
        }]
    },
    options: {
        legend: {
            display: false,
            position: 'bottom',

            labels: {
                fontColor: '#71748d',
                fontFamily: 'Circular Std Book',
                fontSize: 14,
            }
        },


    }
});
</script>

</html>