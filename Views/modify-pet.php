<div class="wrapper row4">
  <main class="hoc container clear"> 
    <!-- main body -->
    <div class="content"> 
      <div class="scrollable">
      <form action="<?php echo FRONT_ROOT . "Pet/Modify" ?>" method="post" >
        <table style="text-align:center;">
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
                <td style="max-width: 100px;">
                  <input type="hidden" name="id" value="<?php echo $pet->getId() ?>">
                  <input type="text" name="name" value="<?php echo $pet->getName() ?>" required>
                </td>
                <td>
                <div >
                    <input class="form__input" type="radio" name="size" value="SMALL" required>Small
                    <input class="form__input" type="radio" name="size" value="MEDIUM">Medium
                    <input class="form__input" type="radio" name="size" value="BIG">Big

                </div>
                </td>   
                <td>
                  <input type="text" name="description" value="<?php echo $pet->getDescription() ?>" required>
                </td>
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