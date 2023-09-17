<div >
  <main > 
    <!-- main body -->
    <div > 
      <div >
      <?php if($keeperListCheck!=null){ ?>
      <form action="<?php echo FRONT_ROOT . "Reservation/Add" ?>" method="post" enctype="multipart/form-data">
        <table style="text-align:center;">
          <thead>
          <thead>              
              <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>UserName</th>
                <th>Remuneration</th>
        



    
              </tr>
          </thead>
          <tbody>
            <?php



              foreach($keeperListCheck as $keeper)
              {
                ?>
                  <tr>  
                    <td><?php echo $keeper->getFirstName()?></td>                    
                    <td><?php echo $keeper->getLastName() ?></td>
                    <td><?php echo $keeper->getUserName() ?></td>
                    <td><?php echo $keeper->getRemuneration() ?></td>
                    <td>
                      
                      <input type="hidden"name="idPet" value="<?php echo $pet ?>">
                      <input type="hidden"name="startDate" value="<?php echo $initialDate ?>">
                      <input type="hidden"name="endDate" value="<?php echo $endDate ?>">
                    </td>
            
                    <td><button type="submit" class="modifyBtn" name="idKeeper" value="<?php echo $keeper->getIdKeeper() ?>"> Reservar </button></td>
                
              
                  </tr>
                <?php
              }
            ?>                          
          </tbody>
        </table>
        <?php }else{ ?>
        <h2 align="center">no keeper was found for those dates</h2>
        <?php } ?>
      </div>
    </div>
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>

<?php 
  include('footer.php');
?>


