<form action="<?php echo FRONT_ROOT."Chat/ShowChatKeeperView"?>" method="post">
<tbody>
        <?php
            foreach($chatList as $chat)
            {
            ?>
                <tr>
                    <td><?php echo $chat->getOwner()->getUserName().":"?></td>
                    <td>
                        <input type="hidden" name="isKeeper" value=False>
                        <input type="hidden" name="idKeeper" value="<?php echo $_SESSION["loggedUser"]->getIdKeeper() ?>">
                        <button type="submit" name="idOwner" class="btn" value="<?php echo $chat->getOwner()->getIdOwner() ?>"> GO CHAT </button>
                    </td>
                    <br>
                </tr>
                
            <?php
            }
        ?>                          
</tbody>      
</form>
    
<?php 
  include('footer.php');
?>