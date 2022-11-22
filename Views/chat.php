<form action="<?php echo FRONT_ROOT."Chat/Add"?>" method="post">
<tbody>
        <?php
            foreach($chatList as $chat)
            {
            ?>
                <tr>
                    <td><?php echo $chat->getIdKeeper()->getUserName().":"?></td>
                    <td><?php echo $chat->getMsg() ?></td>
                    <br>
                </tr>
            <?php
            }
        ?>                          
</tbody>
    
        <input type="text" name="msg">
        <input type="hidden" name="idK" value="<?php echo $chat->getIdKeeper() ?>">
        <input type="hidden" name="idO" value="<?php echo $chat->getIdOwner() ?>">
        <button type="submit" name="" class="btn" value=""> Send </button>
    </form>
    
<?php 
  include('footer.php');
?>