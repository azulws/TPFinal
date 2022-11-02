
<div class="wrapper row4">
  <main class="hoc container clear"> 
    <!-- main body -->
    <div class="content"> 
        <div id="comments" style="align-items:center;">
            <h2 align="center">Insert New Availability</h2>
            <form align="center" action="<?php echo FRONT_ROOT."Keeper/addAvailability" ?>" method="post" enctype="multipart/form-data">
            <table align="center"> 
                <thead>              
                <tr align="center">
                    <th ><h1 class="date-ava">Date:</h1></th>
                </tr>
                </thead>
                <tbody align="center">
                <tr>
                    <td>
                    <input  type="date" name="date" required>
                    </td>
                </tr>
                </tbody>
            </table>
            <div>
                <input type="submit" class="btn-encriptar" value="Confirm"/>
            </div>
            <div>
            </form>
        </div>
        <div class="scrollable">
        <h2 align="center">Availability List: <?php echo $_SESSION["loggedUser"]->getUserName()?></h2>
          <form action="<?php echo FRONT_ROOT."Keeper/RemoveAvailability"?>" method="post">
            <table style="text-align:center;">
              <thead>              
                  <tr>
                    <th>Date</th>
                    <th>Keeper</th>
                  </tr>
              </thead>
              <tbody>
                <?php
                  var_dump($_SESSION["loggedUser"]->getAvailability());
                  foreach($_SESSION["loggedUser"]->getAvailability() as $availability){
                    ?>
                      <tr>
                        <td><?php echo $availability ?></td>
                        <td>
                        <button type="submit" name="date" class="btn" value="$availability"> Remove </button>
                        </td>
                      </tr>
                    <?php
                  }
                ?>                          
              </tbody>
            </table>
          </form>
        </div>
    </div>
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>

<?php 
    include_once('footer.php');
?>