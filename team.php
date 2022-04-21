<?php include"session.php";
include"function/function.php";
$con = new Databases; ?>
<ul class="top-sales-details">
    <?php
        $members = $con->teamMember($login_id);
        if(!empty($members))
        {
            foreach($members as $member)
            {
                ?>
                <li>
                    <a href="#">
                        <img src="../assets/images/profile/<?php echo $member['profile']?>" alt="">
                            <span class="product"><?php echo $member['names']?></span>
                    </a>
                </li>
                <?php
            }
        }
    ?>
                        