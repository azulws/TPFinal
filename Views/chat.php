<form action="<?php echo FRONT_ROOT."Chat/Add"?>" method="post">
<tbody>
        <?php
        if(isset($chatList)){
            foreach($chatList as $chat)
            { var_dump($idKeeper);
                var_dump($idOwner);
            ?>
                <tr>
                    <td><?php echo $chat->getKeeper()->getUserName().":"?></td>
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
        <button type="submit" name="" class="btn" value=""> Send </button>
    </form>
    
<?php 
  include('footer.php');
?>