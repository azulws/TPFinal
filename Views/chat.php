<form action="<?php echo FRONT_ROOT."Chat/Add"?>" method="post">
<tbody>
        <?php
        if(isset($chatList)){
            foreach($chatList as $chat)
            {
            ?>
                <tr>
                    <?php
                        if($chat->getIsKeeper()=="True"){
                    ?>
                        <td><?php echo $chat->getOwner()->getUserName().":"?></td>
                    <?php 
                        }else{
                    ?>
                        <td><?php echo $chat->getKeeper()->getUserName().":"?></td>
                        <?php 
                        }
                    ?>
                    <td><?php echo $chat->getMsg();?></td>
                    <br>
                </tr>
                
            <?php
            }
        }
        ?>                          
</tbody>
        <input type="text" name="msg">
        <input type="hidden" name="idKeeper" value="<?php echo $idKeeper ?>">
        <input type="hidden" name="idOwner" value="<?php echo $idOwner ?>">
        <input type="hidden" name="isKeeper" value="<?php echo $isKeeper ?>">
        <button type="submit" name="" class="btn" value=""> Send </button>
    </form>
    
<?php 
  include('footer.php');
?>