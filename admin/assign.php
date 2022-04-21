<?php
if($login_role == 'admin')
{?>
<section class="post">
    <h2> Add New Project</h2>
    <div class="container">
        <section class="post">
            <div class="week-form">
                <div class="form">
                    <form action="index.php?assignProgress" method="POST">
                        <label for="name">Project Name</label>
                        <input type="text" name="name" placeholder="Project Name" id="name">
                        <label for="assign">Assign</label>
                        <select name="assigned" id="assign">
                            <option>--Developer--</option>
                            <?php
                            $users = $con->oneTable('users');
                            if(!empty($users))
                            {
                                foreach($users as $user)
                                {
                                    if($user['role'] != 'developer')
                                    continue;
                                    ?>
                                    <option value="<?=$user['uId'];?>"><?=$user['names'];?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        <label for="designer">Designer</label>
                        <select name="designer" id="designer">
                            <option>--Developer--</option>
                            <?php
                            $users = $con->oneTable('users');
                            if(!empty($users))
                            {
                                foreach($users as $user)
                                {
                                    if($user['role'] != 'designer')
                                    continue;
                                    ?>
                                    <option value="<?=$user['uId'];?>"><?=$user['names'];?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        <label for="start">Start Date</label>
                        <input type="date" name="startDate" id="start">
                        <label for="due">Due Date</label>
                        <input type="date" name="dueDate" id="due">
                        <label for="description">Description</label>
                        <textarea name="description" id="description"></textarea>
                        <input type="submit" name="assign" value="Submit">
                    </form>
                </div>
            </div>
        </section>
    </div>
</section>
<?php }?>

<?php
if($login_role == 'marketing')
{?>

<section class="post">
    <h2> Add New Project</h2>
    <div class="container">
        <section class="post">
            <div class="week-form">
                <div class="form">
                    <form action="index.php?assignProgress" method="POST">
                        <label for="name">Project Name</label>
                        <input type="text" name="name" placeholder="Project Name" id="name">
                        <label for="start">Start Date</label>
                        <input type="date" name="startDate" id="start">
                        <label for="due">Due Date</label>
                        <input type="date" name="dueDate" id="due">
                        <label for="description">Description</label>
                        <textarea name="description" id="description"></textarea>
                        <input type="submit" name="assignMarketing" value="Submit">
                    </form>
                </div>
            </div>
        </section>
    </div>
</section>

<?php }
?>