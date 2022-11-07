<div >
  <main > 
    <!-- main body -->
    <div > 
      <div >
      <form action="<?php echo FRONT_ROOT . "Pet/Modify" ?>" method="post" >
        <table class="customTable">
          <thead>
          <thead>              
              <tr>
                <th>Name</th>
                <th>Tamaño</th>
                <th>Description</th>       
                <th>Imagen</th>
                <th>Vaccination</th>
                <th>Video</th>
              </tr>
          </thead>
          <tbody align="center">
              <tr>
              <div class="form__group">
                <td >
                  <input type="hidden" name="id" value="<?php echo $pet->getId() ?>">
                  <input type="text" class="form__input" name="name" value="<?php echo $pet->getName() ?>" required>
                </td>
              </div>  
              <div class="box">
                <td>
                  <select name="petType" >
                    <?php
                
                
                foreach($petTypeList as $petType) {
                  if($petType->getId() == $pet->getPetType()->getId()) {
                    echo "<option selected value=". $petType->getId() .">
                    ". $petType->getBreed(). "
                    </option>";
                  } else {
                    echo "<option value=". $petType->getId() .">
                    ". $petType->getBreed(). "
                    </option>";
                  }
                }
                ?>
                  </select>
                <div >
                    <input class="form__input" type="radio" name="size" value="SMALL" required>Small
                    <input class="form__input" type="radio" name="size" value="MEDIUM">Medium
                    <input class="form__input" type="radio" name="size" value="BIG">Big

                </div>
                </td>   
              </div>
              <div class="form__group">
                <td>
                  <input type="text" class="form__input" name="description" value="<?php echo $pet->getDescription() ?>" required>
                </td>
              </div>  
                <td><img alt="No hay imagen" src="<?php echo FRONT_ROOT . IMG_PATH . $_SESSION["loggedUser"]->getUserName()."/". $pet->getImage()?>" width="100" height="100"></td>
                    <td><img alt="No hay imagen" src="<?php echo FRONT_ROOT . IMG_PATH . $_SESSION["loggedUser"]->getUserName()."/". $pet->getVaccination()?>" width="100" height="100"></td>
                    <td><video alt="No hay imagen" src="<?php echo FRONT_ROOT . IMG_PATH . $_SESSION["loggedUser"]->getUserName()."/". $pet->getVideo()?>" width="100" height="100"></td>
                <td>
                  <input type="submit" class="btn" value="Modify" style="background-color:#DC8E47;color:white;"/>
                  <a href="<?php echo FRONT_ROOT . "Pet/ShowAddImgView/" . $pet->getId() ?>" class="btn"> Change Pics or Video </a>
              </td>
                
              </tr>
              </tbody>
        </table>
      
            
          
      </div>
    </div>
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>

<?php 
    include_once('footer.php');
?>