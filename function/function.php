<?php
 class Databases{  
    public $con;  
    public function __construct()  
    {  
         $this->con = mysqli_connect("localhost", "root", "", "report");  
         if(!$this->con)  
         {  
              echo 'Database Connection Error ' . mysqli_connect_error($this->con);  
         }  
    }
    //report
    function allUsersQuery($startDay,$endDay) {
        $projects = mysqli_query($this->con,"SELECT `project`.`name` as `project`,COUNT(`tasks`.`tId`) as `task`,`users`.`names` as `username`, `updates`.`updateDate` as `completed`FROM users JOIN project on users.uId=project.assigned JOIN tasks ON project.pId=tasks.pId JOIN updates ON tasks.tId=updates.tId
        WHERE  (`updates`.`updateDate` BETWEEN '$startDay' AND '$endDay') AND `tasks`.`status` = 'completed' AND `updates`.`uDescription` = 'Done' GROUP BY `tasks`.`pId` ORDER BY `updates`.`updateDate`");
        while($project = mysqli_fetch_assoc($projects))
        {
            $array[] = $project;
        }
        if(!empty($array))
            return $array;
    }
    function allUserInProgress($startDay,$endDay) {
        $projectsInProgress = mysqli_query($this->con,"SELECT `project`.`name` as `project`,`project`.`pId` as `projectid`,COUNT(`tasks`.`tId`) as `task`,`users`.`names` as `username`, `updates`.`updateDate` as `completed`FROM users JOIN project on users.uId=project.assigned JOIN tasks ON project.pId=tasks.pId JOIN updates ON tasks.tId=updates.tId
        WHERE  (`updates`.`lastUpdate` BETWEEN '$startDay' AND '$endDay') AND `tasks`.`status` = 'inprogress' GROUP BY `tasks`.`pId`");
        while($project = mysqli_fetch_assoc($projectsInProgress))
        {
            $array[] = $project;
        }
        if(!empty($array))
            return $array;
    }

    function allUserNotStarted() {
        $projects = mysqli_query($this->con,"SELECT `project`.`name` as `project`,`users`.`names` as `username`, `project`.`start_date` as `estmated` FROM `users` JOIN `project` on `users`.`uId`=`project`.`assigned` WHERE `project`.`status` = 'new'");
        while($project = mysqli_fetch_array($projects))
        {
            $array[] = $project;
        }
        if(!empty($array))
            return $array;
    }


    function listTasks($project, $progress){
        $tasks = mysqli_query($this->con, "SELECT `tasks`.`name` as `task`, `project`.`pId`,`updates`.`uDescription` as `desc`
         FROM `project` JOIN `tasks` ON `project`.`pId` = `tasks`.`pId` JOIN `updates` ON `tasks`.`tId` = `updates`.`tId` WHERE `project`.`pId` = '$project' AND `tasks`.`status` = '$progress'");
         while($task = mysqli_fetch_assoc($tasks))
         {
             $array[] = $task;
         }
         if(!empty($array))
            return $array;
    }

    function priorities($user,$progress){
        $priorities = mysqli_query($this->con, "SELECT * FROM `priorities` WHERE `uId` = '$user' AND `priorityStatus` = '$progress'");
        while($priority = mysqli_fetch_assoc($priorities))
        {
            $array[] = $priority;
        }
        //$empy_array[] = ;
        if(!empty($array))
            return $array;
    }

    function insert($tbl_name,$data){
        $string = "INSERT INTO " .$tbl_name."(";
        $string .= implode(",", array_keys($data)) . ') VALUES (';
        $string .= "'" . implode("','", array_values($data)) . "')";
        if(mysqli_query($this->con, $string)){
            return true;
        }
    }

    function update($table,$data,$condition)
    {
        $cond = '';
        $fields = '';
        foreach($condition as $key => $value)
        {
            $cond .= $key . "='".$value."'"; 
        }
        foreach($data as $key => $value)
        {
            $fields .= $key . "='".$value."',"; 
        }
        $fields = substr($fields, 0, -1);
        $string = "UPDATE ".$table." SET ".$fields." WHERE ".$cond."";
        if(mysqli_query($this->con,$string))
            return true;
    }
    function singleTable($table,$condition,$value)
    {
        $tables = mysqli_query($this->con,"SELECT * FROM ".$table." WHERE ".$condition." = '$value'");
        while ($table = mysqli_fetch_array($tables))
        {
            $array[]= $table;
        }
        if(!empty($array))
            return $array;
    }


    function oneTable($tble)
    {
        $tables = mysqli_query($this->con,"SELECT * FROM ".$tble."");
        while ($table = mysqli_fetch_array($tables))
        {
            $array[]= $table;
        }
        if(!empty($array))
            return $array;
    }

    function twoTable($tbl1,$tbl2,$condition1,$condition2){
        $table = mysqli_query($this->con,"SELECT * FROM ".$tbl1." JOIN ".$tbl2." ON ".$tbl1.".".$condition1."=".$tbl2.".".$condition2."");
        while($tables = mysqli_fetch_array($table))
        {
            $array[] = $tables;
        }
        if(!empty($array))
            return $array;
    }
    function developerWeekly($user,$projectId,$startDay,$endDay,$status)
    {
        $tables = mysqli_query($this->con,"SELECT COUNT(`tasks`.`tId`) as `task` FROM project JOIN tasks ON project.pId=tasks.pId 
        WHERE (`tasks`.`lastUpdate` BETWEEN '$startDay' AND '$endDay') AND 
                                     `tasks`.`status` = '$status' AND `project`.`pId` = '$projectId'");
        while($table = mysqli_fetch_array($tables))
        {
            $array[] = $table;
        }
        if(!empty($array))
            return $array;
    }

    function designerWeekly($user,$projectId,$startDay,$endDay,$status)
    {
        $tables = mysqli_query($this->con,"SELECT `project`.`name` as `project`,`tasks`.`name` as `task` FROM users JOIN project on users.uId=project.designer 
        JOIN mokeup ON project.pId=mokeup.pId 
                                     WHERE `users`.`uId` = '$user' AND (`mokeup`.`date` BETWEEN '$startDay' AND '$endDay') AND 
                                     `mokeup`.`status` = '$status' AND `project`.`pId` = '$projectId'");
        while($table = mysqli_fetch_array($tables))
        {
            $array[] = $table;
        }
        if(!empty($array))
            return $array;
    }








    function assignedProject($user)
    {
        $assigned = mysqli_query($this->con, "SELECT COUNT(`pId`) as assigned FROM `project` WHERE `assigned` = '$user'");
        while($assign = mysqli_fetch_assoc($assigned))
        {
            $array[] = $assign;
        }
        if(!empty($array))
            return $array;
    }

    function projects($user,$progress)
    {
        $assigned = mysqli_query($this->con, "SELECT COUNT(`pId`) as progress FROM `project` WHERE `assigned` = '$user' and `status` = '$progress'");
        while($assign = mysqli_fetch_assoc($assigned))
        {
            $array[] = $assign;
        }
        if(!empty($array))
            return $array;
    }

    function projectProgress($user){
        $projects = mysqli_query($this->con, "SELECT * FROM `project` JOIN `users` ON `users`.`uId` = `project`.`assigned` WHERE `project`.`assigned` = '$user'");
        while($project = mysqli_fetch_assoc($projects))
        {
            $array[] = $project;
        }
        if(!empty($array))
            return $array;
    }

    function listOfUsers()
    {
        $users = mysqli_query($this->con, "SELECT * FROM `users`");
        while($user = mysqli_fetch_array($users))
        {
            $array[] = $user;
        }
        if(!empty($array))
            return $array;
    }

    function tasks($user)
    {
        $tasks = mysqli_query($this->con, "SELECT `tasks`.`status` as `status`,`tasks`.`name` as `task`,`project`.`name` as `project` FROM `project` JOIN `tasks` ON `project`.`pId` = `tasks`.`pId` WHERE `project`.`assigned` = '$user'");
        while($task = mysqli_fetch_assoc($tasks))
        {
            $array[] = $task;
        }
        if(!empty($array))
            return $array;
    }

    function taskOnProject($project)
    {
        $tasks = mysqli_query($this->con, "SELECT * FROM `tasks` WHERE `pId` = '$project' ORDER BY  `created` DESC");
        while($task = mysqli_fetch_assoc($tasks))
        {
            $array[] = $task;
        }
        if(!empty($array))
            return $array;
    }

    function project($project){
        $projects = mysqli_query($this->con, "SELECT * FROM `project` WHERE `pId` = '$project'");
        while($project = mysqli_fetch_assoc($projects))
        {
            $array[] = $project;
        }
        if(!empty($array))
            return $array;
    }

    function updateTask($status, $id)
    {
        $update = mysqli_query($this->con,"UPDATE `tasks` SET `status` ='$status' WHERE `tId` = '$id'");
        return $update;        
    }
    //list of project for users

    function userProject($user)
    {
        $projects = mysqli_query($this->con, "SELECT * FROM `project` WHERE `assigned` = '$user'");
        while($project = mysqli_fetch_array($projects)){
            $array[]=$project;
        }
        if(!empty($array))
            return $array;
    }

    
    
    function notIn($user)
    {
        $notIn = mysqli_query($this->con, "SELECT * FROM users WHERE uId NOT IN( SELECT users.uId FROM team JOIN users ON users.uId=team.member JOIN teams ON teams.team_id=team.team WHERE users.uId ='$user')");
        while($users = mysqli_fetch_array($notIn))
        {
            $array[] = $users;
        }
        if(!empty($array))
            return $array;
    }
    
    function livesearch($search)
    {
        $likes = mysqli_query($this->con, "SELECT * FROM users WHERE names LIKE '%$search%' LIMIT 3");
        while($like = mysqli_fetch_array($likes))
        {
            $array[]=$like;
        }
        if(!empty($array))
            return $array;
    }
    
    function teamMember($user){
        $teams = mysqli_query($this->con, "SELECT `team` FROM `team` WHERE `member`= '$user'"); 
        while($team = mysqli_fetch_assoc($teams))
        {
            $team = $team['team'];
            $members = mysqli_query($this->con, "SELECT * FROM `team` JOIN `users` ON `users`.`uId` = `team`.`member` WHERE `team` = '$team'");
            while($member = mysqli_fetch_assoc($members))
            {
                $array[] = $member;
            }
        }
        if(!empty($array))
            return $array;
    }

    function notInTable($tble1,$tble2,$condition,$cond,$conditionValue)
    {
        $notIn = mysqli_query($this->con, "SELECT * FROM ".$tble1." WHERE '$condition' ='$conditionValue' AND '$condition' NOT IN( SELECT '$cond' FROM ".$tble2.")");
        while($users = mysqli_fetch_array($notIn))
        {
            $array[] = $users;
        }
        if(!empty($array))
            return $array;
    }

}