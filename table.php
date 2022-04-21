<?php 
if(!isset($con))
{
  include"session.php";
  include"function/function.php";
  $con = new Databases;
}
 ?>
<div class="workiing-on-projects">
        <div class="st_viewport">
          <?php 
          if($login_role =='admin'){
            $users = $con->listOfUsers();
            foreach ($users as $user)
            {
              if((!empty($user)) && ($user['role'] =='developer'))
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
                    {?>
                      
                    <div class="st_row">

                    <a class="st_column project-name" href="index.php?newProjects&id=<?php echo $assignProject['pId']; ?>"><?php echo $assignProject['name']; ?></a>
                      <div class="st_column"><?php echo $assignProject['names']; ?></div>
                      <div class="st_column"><?php echo $assignProject['status']; ?></div>
                      <div class="st_column"><?php echo $assignProject['due_date']; ?></div>
                    </div>
                    <?php
                    }}
                    ?>
                  </div>
                </div>

              <?php 
              }
              elseif($user['role'] == "designer"){?>
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
                    $assignProjects = $con->twoTable("users","project","uId","designer");
                    if(!empty($assignProjects))
                    {
                    foreach ($assignProjects as $assignProject)
                    {
                      if($assignProject['uId'] != $user['uId'])
            continue;
            ?>
                    <div class="st_row">
                      <a class="st_column project-name"><?php echo $assignProject['name']; ?></a>
                      <div class="st_column"><?php echo $assignProject['names']; ?></div>
                      <div class="st_column"><?php echo $assignProject['status']; ?></div>
                      <div class="st_column"><?php echo $assignProject['due_date']; ?></div>
                    </div>
                    <?php
                    }}
                    ?>
                  </div>
                </div>
              <?php }
              }
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
                    $assignProjects = $con->twoTable("users","project","uId","designer",$login_id);
                    if(!empty($assignProjects))
                    {
                    foreach ($assignProjects as $assignProject)
                    {
                      if($assignProject['uId'] != $login_id)
                        continue;
                    ?>
                      
                    <div class="st_row">
                      <a class="st_column project-name" href="index.php?newProjects&id=<?php echo $assignProject['pId']; ?>"><?php echo $assignProject['name']; ?></a>
                      <div class="st_column"><?php echo $assignProject['names']; ?></div>
                      <div class="st_column"><?php echo $assignProject['status']; ?></div>
                      <div class="st_column"><?php echo $assignProject['due_date']; ?></div>
                    </div>
                    <?php
                    }}
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
                    {?>
                      
                    <div class="st_row">
                      <a class="st_column project-name" href="index.php?newProjects&id=<?php echo $assignProject['pId']; ?>"><?php echo $assignProject['name']; ?></a>
                      <div class="st_column"><?php echo $assignProject['names']; ?></div>
                      <div class="st_column"><?php echo $assignProject['status']; ?></div>
                      <div class="st_column"><?php echo $assignProject['due_date']; ?></div>
                    </div>
                    <?php
                    }}
                    ?>
            </div>
        </div>
        <?php
      }
      ?>
    </div>
</div>