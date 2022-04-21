<?php
$id=$_GET['id'];
?>
<section class="post">
    <h2> Working Report</h2>
                <div class="form">
                    <form action="index.php?updateProgresses" method="POST">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <label for="name">name of Task</label>
                        <select name="name" id="name">
                        <option value="">--select task--</option>
                            <?php
                                $tasks = $con->singleTable('tasks','pId',$id);
                                if(!empty($tasks))
                                {
                                    foreach($tasks as $task)
                                    {
                                        if($task['status'] == "completed")
                                        continue;
                                            ?>
                                            <option value="<?=$task['tId'];?>"><?=$task['name'];?></option>
                                        <?php
                                    }
                                }
                                    
                            ?>
                        </select>
                        <label for="progress">Progress</label>
                        <select name="progress" id="progress">
                            <option value="completed">COMPLETED</option>
                            <option value="inprogress">INPROGRESS</option>
                            <option value="nextweek">NEXT WEEK</option>
                            <option value="issue">HAVE ISSUE</option>
                        </select>
                        <label for="date">Due Date</label>
                        <input type="date" name="date" id="date">
                        <label for="description">Description</label>
                        <textarea name="description" id="description"></textarea>
                        <input type="submit" name="updateProgress" value="Submit">
                    </form>
                </div>
</section>