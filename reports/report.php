<section class="post">
    
    <div class="report-form">
        <form action="">
                <?php
                if($login_role != "admin")
                {?>
                    <input type='hidden' id="user" name='user' value='<?=$login_id?>'>
                <?php }else{?>
                <div class="fields">
                <label for="user">USERS</label>
                <select name="user" id="user">
                <option value="all-users"> All</option>
                    <?php
                    $users = $con->listOfUsers();
                    if(!empty($users))
                    {
                        foreach($users as $user)
                        {
                        ?>
                        <option value="<?=$user['uId']?>"><?=$user['names']?></option>
                        <?php
                    }}
                ?>
            </select>
        </div>
            <?php }?>
            
            <div class="fields">
                <label for="startDate">FROM</label>
                <input type="date" id="startDate" name="startDate">
            </div>
            <div class="fields">
                <label for="endDate">TO</label>
                <input type="date" id="endDate" name="endDate">
            </div>
            <div class="fields">
            <input type="submit" onClick="returnReport()" value="report" name="">
            </div>
            
            
        </form>
    </div>
    <div id="report">
    
    </div>
</section>

<script type="text/javascript">

function returnReport(){
    $("form").bind('submit',function(e) {
            var formData = {
        user: $("#user").val(),
        startDate: $("#startDate").val(),
        endDate: $("#endDate").val(),
    };
    $.post('../reports/reportData.php',formData, function(data){
        $("#report").html(data);
    });
           return false;
        });
}

$(function() {
    
        
        e.preventDefault();
      });
</script>

<style>
    .report-form{
        width:100%;
    }
    .report-form form{
        display: flex;
    }
    .fields{
        flex:1;
        padding: 10px
    }
    .fields input[type=submit]{
        margin-top: 30px;
    }
</style>

