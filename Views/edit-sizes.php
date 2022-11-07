<div >
        <h2 align="center">Pet Sizes</h2>
        <br>
        <form align="center" action="<?php echo FRONT_ROOT."Keeper/EditSize" ?>" method="post" enctype="multipart/form-data">
        <h2>Your chosen pet sizes</h2>
        <?php
                foreach($sizesList as $size){
                    ?>
                    <tr>
                        <td><?php echo $size?></td>
                        
                    </tr>
                    <?php
                }
                ?>       
            <br>
            <br>
            <br>
            
                <h3>What size of pets do you want to take care of? </h3>
                <div >
                    <input class="form__input" type="checkbox" name="size[]" value="SMALL" checked>Small
                    <input class="form__input" type="checkbox" name="size[]" value="MEDIUM">Medium
                    <input class="form__input" type="checkbox" name="size[]" value="BIG">Big

                </div>
            <br>
            
        
        <div align="center">
            <input type="submit" class="btn-encriptar" value="Agregar" />
        </div>
        
        </form>
    </div>
    
    <!-- / main body -->
    
</main>

<?php 
    include_once('footer.php');
?>
