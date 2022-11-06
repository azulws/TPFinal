<main class="main">
  <div align = "center">
    <br>
    <h1>MENU OWNER</h1>
  </div>
  <br>
  <div align ="center">
    <a class="btn-desencriptar" href="<?php echo FRONT_ROOT . "Keeper/ShowListView"?>">KEEPER LIST</a>
    <br>
    <a class="btn-desencriptar" href="<?php echo FRONT_ROOT . "Pet/ShowAddView"?>">ADD PET</a>
    <br>
    <a class="btn-desencriptar" href="<?php echo FRONT_ROOT . "Pet/ShowListView"?>">  MY PETS</a>
    <br>
    <br>
    <a class="btn-desencriptar" href="<?php echo FRONT_ROOT . "Reservation/ShowRecordOwnerView"?>">  MY RESERVATIONS</a>
    <br>
    
    <?php /*<a class="btn-desencriptar" href="<?php echo FRONT_ROOT . "Keeper/checkAllDates"?>">  CHECK DATES</a>
    <br>*/?>

  </div>
</main>



<?php 
    include_once('footer.php');
?>