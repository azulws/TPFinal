<form action="<?php echo FRONT_ROOT."Chat/Add"?>" method="post">
<body >
    <div >
    <section class="chat-box">
        <?php
        if(isset($chatList)){
            foreach($chatList as $chat)
            {
            ?>
                <tr>
                    <?php
                        if($chat->getIsKeeper()=="True"){
                    ?>
                    <br>
                    <br>
                    <br>
                   
                        <td><?php echo $chat->getOwner()->getUserName().":"?></td>
                      
                    <?php 
                        }else{
                    ?>
                        <td><?php echo $chat->getKeeper()->getUserName().":"?></td>
                        <?php 
                        }
                    ?>
                    
                    <td><a class="burbuja"><?php echo $chat->getMsg();?></a></td>
                    <br>
                    <br>
                </tr>
                
            <?php
            }
        }
        ?>       
        </section>                  
        
        <input class="sendInput" type="text" name="msg" required>
        <input type="hidden" name="idKeeper" value="<?php echo $idKeeper ?>">
        <input type="hidden" name="idOwner" value="<?php echo $idOwner ?>">
        <input type="hidden" name="isKeeper" value="<?php echo $isKeeper ?>">
        <button type="submit" name="" class="sendBtn" value=""> Send </button>
        
    </form>

    </div>
</body>

<?php 
  include('footer.php');
?>