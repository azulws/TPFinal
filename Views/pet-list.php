<?php 
    include('nav-bar.php');
?>
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
                <th>Name</th>
                <th>Tamaño</th>
                <th>Description</th>       
                <th>Imagen</th>
                <th>Vaccination</th>
              </tr>
          </thead>
          <tbody>
            <?php
              foreach($petList as $pet)
              {
                ?>
                  <tr>
                    <td><?php echo $pet->getName() ?></td>
                    <td><?php echo $pet->getPetType()->getSize() ?></td>
                    <td><?php echo $pet->getDescription() ?></td>
                    <td><img src="<?php echo FRONT_ROOT . IMG_PATH . $_SESSION["loggedUser"]->getUserName()."/". $pet->getImage()?>" width="100" height="100"></td>
                    <td><img src="<?php echo FRONT_ROOT . IMG_PATH . $_SESSION["loggedUser"]->getUserName()."/". $pet->getVaccination()?>" width="100" height="100"></td>
                    <td>
                        <a href="<?php echo FRONT_ROOT . "Pet/ShowModifyView/" . $pet->getId() ?>" class="btn"> Modify </a>
                        <button type="submit" name="id" class="btn" value="<?php echo $pet->getId() ?>"> Remove </button>
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