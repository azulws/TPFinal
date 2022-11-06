
<div class="wrapper row4">
  <main class="hoc container clear"> 
    <!-- main body -->
    <div class="content"> 
      <div class="scrollable">
      <form action="<?php echo FRONT_ROOT . "Pet/Remove" ?>" method="post" enctype="multipart/form-data">
        <table style="text-align:center;">
          <thead>
          <thead>              
              <tr>
                <th>Race</th>
                <th>Name</th>
                <th>Tamaño</th>
                <th>Description</th>       
                <th>Imagen</th>
                <th>Vaccination</th>
                <th>Video</th>
              </tr>
          </thead>
          <tbody>
            <?php
              foreach($petList as $pet)
              {
                ?>
                  <tr>
                    <td><?php echo $pet->getPetType()->getBreed() ?></td>
                    <td><?php echo $pet->getName() ?></td>
                    <td><?php echo $pet->getSize() ?></td>
                    <td><?php echo $pet->getDescription() ?></td>
                    <td><img alt="No hay imagen" src="<?php echo FRONT_ROOT . IMG_PATH . $_SESSION["loggedUser"]->getUserName()."/". $pet->getImage()?>" width="100" height="100"></td>
                    <td><img alt="No hay imagen" src="<?php echo FRONT_ROOT . IMG_PATH . $_SESSION["loggedUser"]->getUserName()."/". $pet->getVaccination()?>" width="100" height="100"></td>
                    <td><video alt="No hay imagen" controls src="<?php echo FRONT_ROOT . IMG_PATH . $_SESSION["loggedUser"]->getUserName()."/". $pet->getVideo()?>" width="100" height="100"></td>
                    <td>
                        <a href="<?php echo FRONT_ROOT . "Pet/ShowModifyView/" . $pet->getId() ?>" class="btn"> Modify </a>
                        <button type="submit" name="id" class="btn" value="<?php echo $pet->getId() ?>"> Remove </button>
                        <a href="<?php echo FRONT_ROOT . "Keeper/ShowCheckDatesView/" . $pet->getId() ?>" class="btn"> Search Keeper </a>
                    </td>
                  </tr>
                <?php
              }
            ?>                          
          </tbody>
        </table>
      </div>
    </div>
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>

<?php 
  include('footer.php');
?>