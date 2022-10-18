<main>
<div align = "center">
    <h1>MENU KEEPER</h1>
</div>
<h3>Add renumeration:</h3>
<div align="center">
  <form align="center" action="<?php echo FRONT_ROOT."Keeper/Modify"?>" method="post">
  <div class="formgroup">
    <input type="text" class="forminput" name="remuneration" placeholder="Remuneration" required>
    <label for="renumeration" class="form__label">Renumeration</label>
    <input type="submit" value="Remuneration">
  </div>
</div>
<div align ="center">
    <a class="btn-encriptar" href="<?php echo FRONT_ROOT . "Availability/ShowListView"?>">AVAILABILITY </a>
</div>



</main>

<?php 
    include_once('footer.php');
?>