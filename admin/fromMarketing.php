<?php 
if(!isset($con))
{
  include"session.php";
  include"function/function.php";
  $con = new Databases;
}
 ?>
 <div class="workiing-on-projects">
        <div class="st_viewport project-list">
        <div class="st_wrap_table" data-table_id="">
                  <div class="st_table_header">
                    <div class="st_row">
                      <div class="st_column _name">Project Name</div>
                      <div class="st_column _surname">Added By</div>
                      <div class="st_column _surname">Assignee</div>
                      <div class="st_column _year">Status</div>
                      <div class="st_column _section">Deadline</div>
                    </div>
                  </div>
                  <div class="st_table">
                    <?php
                     $assignProjects = $con->twoTable("users","project","uId","addedBy");
                     if(!empty($assignProjects))
                     {
                     foreach ($assignProjects as $assignProject)
                     { $taskNumb=0;
                      $taskCompleted=0;
                      $taskIncompl=0;
                      $taskprogress = 0;
                      
                      $tasks = $con->singleTable('tasks','pId',$assignProject['pId']);
                      if(!empty($tasks))
                      {
                        foreach($tasks as $task)
                          {
                            $taskNumb ++;
                            if($task['status'] == "completed")
                              $taskCompleted ++;
                              
                            else
                              $taskIncompl ++;
                          }
                          $taskprogress = ($taskCompleted * 100) / $taskNumb;
                      }

                       if($assignProject['role'] != 'marketing')
                        continue;
                       $assign = "Not Yet Assigned";
                       $users = $con->singleTable('users','uId',$assignProject['assigned']);
                       foreach ($users as $user) 
                        $assign = $user['names'];
                       ?>
                     <div class="st_row">
                       <a class="st_column project-name" href="../Dashboard/index.php?newProjects&id=<?php echo $assignProject['pId']; ?>"><?php echo $assignProject['name']; ?></a>
                       <div class="st_column"><?=$assignProject['names']?></div>
                       <div class="st_column"><?=$assign?></div>
                       <div class="st_column"><?php echo $assignProject['status']; ?> &nbsp;<?=$taskprogress;?>%</div>
                       <div class="st_column"><?php echo $assignProject['due_date']; ?></div>
                     </div>
                     <?php
                     }
                   }
                    ?>
            </div>
        </div>