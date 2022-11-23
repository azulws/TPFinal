<form action="<?php echo FRONT_ROOT."Chat/ShowChatView"?>" method="post">
<tbody>
        <input type="hidden" name="idKeeper" value="<?php echo $_SESSION["loggedUser"]->getIdKeeper() ?>">
        <?php
        
            foreach($ownerList as $owner)
            {
            ?>
                <tr>
                    <td><?php echo $owner->getOwner()->getUserName().":"?></td>
                    <td>
                        <button type="submit" name="idOwner" class="btn" value="<?php echo $owner->getIdOwner() ?>"> GO CHAT </button>
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