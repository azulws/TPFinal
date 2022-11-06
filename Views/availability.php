
<div>
  <main> 
    <!-- main body -->
    <div> 
        <div style="align-items:center;">
        <br>
            <h2 align="center">Insert New Availability</h2>
            <br>
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
            <br>
            <div>
                <input type="submit" class="confirmBtn" value="Confirm"/>
            </div>
            <div>
            </form>
        </div>
        <div >
        <h2 align="center">Availability List: <?php echo $_SESSION["loggedUser"]->getUserName()?></h2>
        <br>
          <form action="<?php echo FRONT_ROOT."Keeper/RemoveAvailability"?>" method="post">
            <table class="customTable" >
              <thead>              
                  <tr>
                    <th>Date</th>
                    <th>Keeper</th>
                  </tr>
              </thead>
              <tbody>
                <?php
                  foreach($availabilityList as $availability){
                    ?>
                      <tr>
                        <td><?php echo $availability ?></td>
                        <td>
                        <button type="submit" name="date" class="removeBtn" value="<?php echo $availability ?>"> Remove </button>
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