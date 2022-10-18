<main>
<h3 align="center">Add renumeration:</h3>
<div align="center">
  <form action="<?php echo FRONT_ROOT."Keeper/Modify"?>" method="post">
  <div class="form__group">
    <input type="number" class="form__input" name="remuneration" placeholder="Remuneration" required>
    <label for="renumeration" class="form__label">Insert Remuneration</label>
    <input class="btn-desencriptar" type="submit" value="Confirm">
  </div>
</div>
<br>
<div align = "center">
    <h1>MENU KEEPER</h1>
</div>
<div align ="center">
    <a class="btn-encriptar" href="<?php echo FRONT_ROOT . "Availability/ShowListView"?>">AVAILABILITY </a>
</div>



</main>

<?php 
    include_once('footer.php');
?>