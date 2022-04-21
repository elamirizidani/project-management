<ul><?php
  include "../function/function.php";
$con = new Databases;
include "session.php";
 
  if (isset($_POST['query'])) {
      $results = $con->livesearch($_POST['query'],$login_id);
      if(!empty($results)) {
        foreach($results as $result)
        {
?>
            <li onclick="submitMember()" id="addToTeam" data-id="<?=$result['uId']?>">
                    <form method="post" id="addToTeamForm<?=$result['uId']?>" action="../Dashboard/index.php?toteam">
                      <input type="hidden" name="userid" value="<?=$result['uId']?>">
                      <input type="submit" class="adduser" style="display:none" name="addToTeam">
                      <a href="javascript:void(0);">
                        <img src="../assets/images/profile/<?php echo $result['profile']?>" alt="">
                            <span class="product"><?php echo $result['names']?></span>
                    </a>
                    </form>
                </li>
            <?php
        }
      } else {
      echo "
      <li class='alert alert-danger mt-3 text-center' role='alert'>
          user not found
      </li>
      ";
    }
  }
?>
</ul>
<style>
  .adduser{
    background-color: transparent !important;
    color: #000!important;
  }
  .adduser:hover{
    border: .5px solid #000 !important;
  }
</style>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function(){
function submitMember()
{

}
    $("#addToTeam").click(function(){ 
      var id = $(this).data('id');
      //let confirmation = document.getElementById("addToTeamForm"+id);       
        $("#addToTeamForm"+id).submit();
    });
});
</script>