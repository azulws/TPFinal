<form action="<?php echo FRONT_ROOT."Chat/Add"?>" method="post">
<tbody>
        <?php
            foreach($chatList as $chat)
            {
            ?>
                <tr>
                    <td><?php echo $chat->getKeeper()->getUserName().":"?></td>
                    <td><?php echo $chat->getMsg();?></td>
                    <br>
                </tr>
                
            <?php
            }
        ?>                          
</tbody>
        <input type="text" name="msg">
        <input type="hidden" name="keeper" value="<?php echo $chat->getKeeper()->getIdKeeper() ?>">
        <input type="hidden" name="owner" value="<?php echo $chat->getOwner()->getIdOwner() ?>">
        <button type="submit" name="" class="btn" value=""> Send </button>
    </form>
    
<?php 
  include('footer.php');
?>