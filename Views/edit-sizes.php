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
            
                <h3>What size of pets do you want to take care of? </h3>
                <div >
                    <input class="form__input" type="checkbox" name="size[]" value="SMALL" checked>Small
                    <input class="form__input" type="checkbox" name="size[]" value="MEDIUM">Medium
                    <input class="form__input" type="checkbox" name="size[]" value="BIG">Big

                </div>
            <br>
        <div align="center">
            <input type="submit" class="btn-encriptar" value="Change" />
        </div>
        
        </form>
        <br>
        <br>
        <div align="center">
        <h2 align="center">Remuneration</h2>
        <br>
        <h3 align="center">Current remuneration: $<?php echo $keeper->getRemuneration()?></h3>
        <form action="<?php echo FRONT_ROOT."Keeper/Modify"?>" method="post">
            <div class="form__group">
            <input type="number" class="form__input" name="remuneration" placeholder="Change Remuneration" min="0" required>
            <label for="renumeration" class="form__label">Insert Remuneration</label>
            <input class="btn-encriptar" type="submit" value="Change">
        </from>
    
  </div>
    </div>
    
    <!-- / main body -->
    
</main>

<?php 
    include_once('footer.php');
?>
