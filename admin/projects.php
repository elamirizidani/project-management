<?php 
if(!isset($con))
{
  include"session.php";
  include"function/function.php";
  $con = new Databases;
}
if(($login_role == "admin") || ($login_role == "marketing"))
{
    echo '<a href="index.php?addProject"class="btn add-btn">Add New Project</a>';
}
 ?>
 
 <br>
 <br>
<div class="workiing-on-projects">
        <div class="st_viewport project-list">
          <?php 
          if($login_role =='admin'){
            $users = $con->listOfUsers();
            foreach ($users as $user)
            {
              if((!empty($user)) && ($user['role'] !='admin') && ($user['role'] !='marketing') && ($login_role == 'admin'))
              {
              ?>
                <div class="st_wrap_table" data-table_id="<?php echo $user['uId']; ?>">
                  <div class="st_table_header">
                    <h2><?php echo $user['names']; ?></h2>
                    <div class="st_row">
                      <div class="st_column _name">Project Name</div>
                      <div class="st_column _surname">Assignee</div>
                      <div class="st_column _year">Status</div>
                      <div class="st_column _section">Deadline</div>
                    </div>
                  </div>
                  <div class="st_table">
                    <?php
                    $assignProjects = $con->projectProgress($user['uId']);
                    if(!empty($assignProjects))
                    {
                    foreach ($assignProjects as $assignProject)
                    {
                      $taskNumb=0;
                      $taskCompleted=0;
                      $taskIncompl=0;
                      $progress=0;
                      
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
                          $progress = ($taskCompleted * 100) / $taskNumb;
                      }
                      ?>
                      
                    <div class="st_row">

                    <a class="st_column project-name" href="index.php?newProjects&id=<?php echo $assignProject['pId']; ?>"><?php echo $assignProject['name']; ?></a>
                      <div class="st_column"><?php echo $assignProject['names']; ?></div>
                      <div class="st_column"><?php echo $assignProject['status']; ?> &nbsp;<?=$progress?>%</div>
                      <div class="st_column"><?php echo $assignProject['due_date']; ?></div>
                    </div>
                    <?php
                    }}
                    ?>
                  </div>
                </div>

              <?php }}
              }elseif($login_role =='marketing')
              {
                ?>

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
                      $progress=0;
                      
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
                          $progress = ($taskCompleted * 100) / $taskNumb;
                      }

                       if($assignProject['role'] != 'marketing')
                        continue;
                       $assign = "Not Yet Assigned";
                       $users = $con->singleTable('users','uId',$assignProject['assigned']);
                       if(!empty($users))
                       {
                       foreach ($users as $user) 
                        $assign = $user['names'];
                       }
                       ?>
                     <div class="st_row">
                       <a class="st_column project-name" href="../Dashboard/index.php?newProjects&id=<?php echo $assignProject['pId']; ?>"><?php echo $assignProject['name']; ?></a>
                       <div class="st_column"><?=$assignProject['names']?></div>
                       <div class="st_column"><?=$assign?></div>
                       <div class="st_column"><?php echo $assignProject['status']; ?> &nbsp;<?=$progress?>%</div>
                       <div class="st_column"><?php echo $assignProject['due_date']; ?></div>
                     </div>
                     <?php
                     }
                   }
                    ?>
            </div>
        </div>
        <?php
      }
      elseif($login_role == "designer")
{
      ?>

      <div class="st_wrap_table" data-table_id="">
        <div class="st_table_header">
          <div class="st_row">
            <div class="st_column _name">Project Name</div>
            <div class="st_column _surname">Assignee</div>
            <div class="st_column _year">Status</div>
            <div class="st_column _section">Deadline</div>
          </div>
        </div>
        <div class="st_table">
          <?php
          $assignProjects = $con->twoTable("users","project","uId","designer");
          if(!empty($assignProjects))
          {
          foreach ($assignProjects as $assignProject)
          {
            if($assignProject['uId'] != $login_id)
            continue;
            $taskNumb=0;
            $taskCompleted=0;
            $taskIncompl=0;
            $progress=0;
            
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
                $progress = ($taskCompleted * 100) / $taskNumb;
            }
            
            ?>
            
          <div class="st_row">
            <a class="st_column project-name" href="../Dashboard/index.php?newProjects&id=<?php echo $assignProject['pId']; ?>"><?php echo $assignProject['name']; ?></a>
            <div class="st_column"><?=$assignProject['names']; ?></div>
            <div class="st_column"><?=$assignProject['status']; ?></div>
            <div class="st_column"><?=$assignProject['due_date']; ?></div>
          </div>
          <?php
          }
        }
          ?>
  </div>
</div>
<?php
}



      else
              {
                ?>

                <div class="st_wrap_table" data-table_id="">
                  <div class="st_table_header">
                    <div class="st_row">
                      <div class="st_column _name">Project Name</div>
                      <div class="st_column _surname">Assignee</div>
                      <div class="st_column _year">Status</div>
                      <div class="st_column _section">Deadline</div>
                    </div>
                  </div>
                  <div class="st_table">
                    <?php
                    $assignProjects = $con->projectProgress($login_id);
                    if(!empty($assignProjects))
                    {
                    foreach ($assignProjects as $assignProject)
                    {
                      $taskNumb=0;
                      $taskCompleted=0;
                      $taskIncompl=0;
                      $progress=0;
                      
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
                          $progress = ($taskCompleted * 100) / $taskNumb;
                      }
                      
                      ?>
                      
                    <div class="st_row">
                      <a class="st_column project-name" href="../Dashboard/index.php?newProjects&id=<?php echo $assignProject['pId']; ?>"><?php echo $assignProject['name']; ?></a>
                      <div class="st_column"><?=$assignProject['names']; ?></div>
                      <div class="st_column"><?=$assignProject['status']; ?> &nbsp;<?=$progress?>%</div>
                      <div class="st_column"><?=$assignProject['due_date']; ?></div>
                    </div>
                    <?php
                    }
                  }
                    ?>
            </div>
        </div>
        <?php
      }
      ?>
    </div>
</div>