
<div> 
    <h1>Add Pet</h1>
</div>


<main class="main"> 
    <!-- main body -->
     
    <div >
        <h2 align="center">Ingresar Datos</h2>
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
                    <input class="form__input" type="radio" name="size" value="Small">Small
                    <input class="form__input" type="radio" name="size" value="Medium">Medium
                    <input class="form__input" type="radio" name="size" value="Big">Big

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
echo "<script> alert('agregado con exito')";
  echo "window.location: '../home.php';</script>";
?>


<?php 
    include_once('footer.php');
?>
  