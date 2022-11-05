<main class="main">
  <div align = "center">
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
    <div id="comments" style="align-items:center;">
            <h2 align="center">Insert Dates</h2>
            <form align="center" action="<?php echo FRONT_ROOT."Keeper/checkDates" ?>" method="post" enctype="multipart/form-data">
            <table align="center"> 
                <thead>              
                <tr align="center">
                    <th ><h1 class="date-ava">Start Date:</h1></th>
                </tr>
                </thead>
                <tbody align="center">
                <tr>
                    <td>
                        <br>
                        <input  type="date" name="startDate" required>
                    </td>
                </tr>
                </tbody>
                <tr align="center">
                    <th ><h1 class="date-ava">End Date:</h1></th>
                </tr>
                </thead>
                <tbody align="center">
                <tr>
                    <td>
                        <br>
                        <input  type="date" name="endDate" required>
                    </td>
                </tr>
                </tbody>
            </table>
            <div>
                <input type="submit" class="btn-encriptar" value="search"/>
            </div>
            <div>
            </form>
        </div>
    <?php /*<a class="btn-desencriptar" href="<?php echo FRONT_ROOT . "Keeper/checkAllDates"?>">  CHECK DATES</a>
    <br>*/?>

  </div>
</main>



<?php 
    include_once('footer.php');
?>