<?php
function allUsers($startDay,$endDay) {
    include '../function/function.php';  
$con = new Databases;
    ?>
    <div class="container">
    <section class="post" id="toBePrinted">
    <div class="monthlyReport">
        <div class="monthlyHeader">
            Team Status Report From "<?php echo $startDay?>" To "<?php echo $endDay?>"
        </div>
        <div class="monthlyCompleted">
            <div class="headerComp comp">
                Completed Items
            </div>
            <div class="bodyComp">
                <div class="compSubBody">
                    <div class="head">Project</div>
                    <div class="head">Task(s)</div>
                    <div class="head">Team Member(s)</div>
                    <div class="head">Date Completed</div>
                </div>
                <?php
                
                $complets = $con->allUsersQuery($startDay,$endDay);
                if(!empty($complets))
                {
                foreach($complets as $complet)
                {?>
                <div class="compSubBody">
                    <div class="bodyContent"><?php echo $complet['project']?></div>
                    <div class="bodyContent"><?php echo $complet['task']?> View</div>
                    <div class="bodyContent"><?php echo $complet['username']?></div>
                    <div class="bodyContent">22020-01-12</div>
                </div>
                <?php }}
                ?>
            </div>

            <div class="headerComp progress">
                Inprogress Items
            </div>
            <div class="bodyComp">
                <div class="compSubBody">
                    <div class="head">Project</div>
                    <div class="head">Task(s)</div>
                    <div class="head">Team Member(s)</div>
                    <div class="head">Date Completed</div>
                </div>
                <?php
                $inprogress = $con->allUserInProgress($startDay,$endDay);
                if(!empty($inprogress))
                {
                foreach($inprogress as $progress)
                {?>
                 
                <div class="compSubBody">
                    <div class="bodyContent"><?php echo $progress['project']?></div>
                    <div class="bodyContent" style="cursor: pointer;" id="show" onclick="onShow()" data-id="<?php echo $progress['projectid']?>"><?php echo $progress['task']?> 
                    
                    View</div>
                    <div class="bodyContent"><?php echo $progress['username']?></div>
                    <div class="bodyContent">22020-01-12</div>
                </div>

                <div id="confirmation<?php echo $progress['projectid']?>" class="model-container">
                    <div class="model">
                        <section>
                            <section class="model-header">
                                <span onclick="onConcel()" id="close" data-id="<?php echo $progress['projectid']?>">&times;</span>
                                <h2><?php echo $progress['project']?></h2>
                            </section>
                            <section class="model-content" id="display">
                                <?php 
                                
                                $id = $progress['projectid'];
                                $tasks = $con->listTasks($id, "inprogress");
                                foreach ($tasks as $task)
                                {
                                    echo $task['task']."<br>";
                                }
                                    
                                    ?>
                            </section>
                        </section>
                    </div>
                </div>
                <?php }}?>
            </div>



            <div class="headerComp progress">
                Assigned But Not Started
            </div>
            <div class="bodyComp">
                <div class="compSubBody">
                    <div class="head">Project</div>
                    <div class="head">Task(s)</div>
                    <div class="head">Team Member(s)</div>
                    <div class="head">Date Completed</div>
                </div>
                <?php
                $notstarteds = $con->allUserNotStarted();
                foreach($notstarteds as $notstarted)
                {?>
                
                <div class="compSubBody">
                    <div class="bodyContent"><?php echo $notstarted['project']?></div>
                    <div class="bodyContent" style="cursor: pointer;">              
                    </div>
                    <div class="bodyContent"><?php echo $notstarted['username']?></div>
                    <div class="bodyContent"><?php echo $notstarted['estmated']?></div>
                </div>
                <?php }?>
            </div>
        </div>
        
    </div>
    </section>
    </div>
    
    <?php
}?>


<script>
    function onShow() {

        $(document).ready(function($) {
            $('body').on('click', '#show', function() {
                var id = $(this).data('id');
                let confirmation = document.getElementById("confirmation"+id);
                if (!confirmation.classList.contains("model-open")) {
                    confirmation.classList.add("model-open");
                    
                }
            });
        });
        
    }
    function onConcel() {
        $(document).ready(function($) {
            $('body').on('click', '#close', function() {
                var id = $(this).data('id');
                let confirmation = document.getElementById("confirmation"+id);
                confirmation.classList.remove("model-open");
            });
        });
    }
    
    function onConfirm() {
        onConcel();
    }
    document.addEventListener("DOMContentLoaded", () => {
        document.getElementById("confirmation").addEventListener("click", onConcel);
        document.querySelector(".model").addEventListener("click", (e) => e.stopPropagation());
    });

    </script>