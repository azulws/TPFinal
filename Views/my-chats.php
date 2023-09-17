<form action="<?php echo FRONT_ROOT."Chat/ShowChatKeeperView"?>" method="post">
<body>
    <div>
    <section class="chat-box">
        <?php
            foreach($chatList as $chat)
            {
            ?>
                <tr>
                    <td ><h3><?php echo $chat->getOwner()->getUserName().":"?></h3></td>
                    <td>
                        <input type="hidden" name="isKeeper" value=False>
                        <input type="hidden" name="idKeeper" value="<?php echo $_SESSION["loggedUser"]->getIdKeeper() ?>">
                        <button type="submit" name="idOwner" class="modifyBtn" value="<?php echo $chat->getOwner()->getIdOwner() ?>"> GO CHAT </button>
                        <br>

                    </td>
                    <br>
                </tr>
                
            <?php
            }
        ?>
        </section >
    </div>                              
</body>      
</form>
    
<?php 
  include('footer.php');
?>