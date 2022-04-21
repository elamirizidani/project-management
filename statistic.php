<?php

if(!empty($con))
{
    include"session.php";
    include"function/function.php";
    $con = new Databases; 
}
?>
                <div class="box">
                    <div class="right-side">
                        <div class="box-topic">Assigned Projects</div>
                        <?php
                            $assigned = $con->assignedProject($login_id);
                            foreach ($assigned as $assign)
                            {
                        ?>
                        <div class="number"><?php echo $assign['assigned']?></div>
                        <?php }?>
                        <div class="indicator">
                            <i class='bx bx-up-arrow-alt'></i>
                            <span class="text">Ready To Start</span>
                        </div>
                    </div>
                    <i class='bx bx-task cart'></i>
                </div>
                <div class="box">
                    <div class="right-side">
                        <div class="box-topic">Total Complete</div>
                        <?php
                            $completed = $con->projects($login_id,"completed");
                            foreach ($completed as $complete)
                            {?>
                        <div class="number"><?php echo $complete['progress']?></div>
                        <?php }?>
                        <div class="indicator">
                            <i class='bx bx-up-arrow-alt'></i>
                            <span class="text">ready to serve</span>
                        </div>
                    </div>
                    <i class='bx bx-user-check cart'></i>
                </div>
                <div class="box">
                    <div class="right-side">
                        <div class="box-topic">Total Inprogress</div>
                        <?php
                            $inprogress = $con->projects($login_id,"progress");
                            foreach ($inprogress as $progress)
                            {
                            ?>
                        <div class="number"><?php echo $progress['progress']?></div>
                        <?php }?>
                        <div class="indicator">
                            <i class='bx bx-up-arrow-alt'></i>
                            <span class="text">We still working on</span>
                        </div>
                    </div>
                    <i class='bx bx-id-card cart'></i>

                </div>
                <div class="box">
                    <div class="right-side">
                        <div class="box-topic">Total Pending</div>
                        <?php
                            $news = $con->projects($login_id,"new");
                            foreach ($news as $new)
                            {
                            ?>
                        <div class="number"><?php echo $new['progress']?></div>
                        <?php }?>
                    </div>
                    <i class='bx bx-time-five cart'></i>
                </div>