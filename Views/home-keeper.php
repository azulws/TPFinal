<main>
<br>
<h3 align="center">Add renumeration:</h3>
<br>
<div align="center">
  <form action="<?php echo FRONT_ROOT."Keeper/Modify"?>" method="post">
  <div class="form__group">
    <input type="number" class="form__input" name="remuneration" placeholder="Remuneration" min="0" required>
    <label for="renumeration" class="form__label">Insert Remuneration</label>
    <input class="btn-desencriptar" type="submit" value="Confirm">
  </div>
</div>
<br>
<div align = "center">
    <h1>MENU KEEPER</h1>
    <br>
</div>
<div align ="center">
    <a class="btn-encriptar" href="<?php echo FRONT_ROOT . "Keeper/ShowAvailabilityView"?>">AVAILABILITY </a>
    <br>
    <a class="btn-desencriptar" href="<?php echo FRONT_ROOT . "Reservation/ShowRecordKeeperView"?>">  MY RESERVATIONS</a>
    <br>
    <a class="btn-desencriptar" href="<?php echo FRONT_ROOT . "Keeper/ShowEditSizesView"?>">  EDIT SIZES</a>
    <br>
    <a class="btn-desencriptar" href="<?php echo FRONT_ROOT . "Chat/ShowChatList"?>">  MY CHATS</a>
    <br>
</div>




</main>

<?php 
    include_once('footer.php');
?>