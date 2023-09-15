<main class="main"> 
    <!-- main body -->
     
    <div >
        <br>
        <h1 align="center">NEW PET</h1>
        <br>
        <form align="center" action="<?php echo FRONT_ROOT."Pet/Add" ?>" method="post" enctype="multipart/form-data">
        
         
            
            
                <div class="form__group">
                <input class="form__input" type="text" name="name" size="22" min="0" placeholder="Name" required>
                <label for="name" class="form__label">Name</label>
                </div>
                <div class="form__group">
                <input class="form__input" type="text" name="description" placeholder="Description" required>
                <label for="description" class="form__label">Description</label>
                </div>                
                <br>
                <div class="box" align="center">    
                <select name="petType" id="petType" style="background-color: #004882;"  >
                    <?php
                        foreach($petTypeList as $petType) {
                        echo "<option value=". $petType->getId() .">
                        ". $petType->getBreed(). "
                        </option >";
                        }
                    ?>
                </select>
                </div >
                <div >
                    <input class="form__input" type="radio" name="size" value="SMALL">Small
                    <input class="form__input" type="radio" name="size" value="MEDIUM">Medium
                    <input class="form__input" type="radio" name="size" value="BIG">Big

                </div>
            <br>
        
        <div align="center">
            <input type="submit" class="btn-encriptar" value="ADD PET" />
        </div>
        
        </form>
    </div>
    
    <!-- / main body -->
    
</main>

<?php
echo "<script> alert('agregado con exito')";
  echo "window.location: '../home.php';</script>";
?>


<?php 
    include_once('footer.php');
?>
  