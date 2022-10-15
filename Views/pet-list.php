<?php 
    include('header.php');
    include('nav-bar.php');
?>
<div class="wrapper row4">
  <main class="hoc container clear"> 
    <!-- main body -->
    <div class="content"> 
      <div class="scrollable">
      <form action="<?php echo FRONT_ROOT . "Pet/Remove" ?>" method="post">
        <table style="text-align:center;">
          <thead>
          <thead>              
              <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Tamaño</th>       
                <th>Imagen</th>
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
                    <td><?php echo "aca iria la img"?></td>
                    <td>
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