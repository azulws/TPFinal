<div class="wrapper row4">
  <main class="hoc container clear"> 
    <!-- main body -->
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
    <div class="content"> 
        <div class="scrollable">
        <h2 align="center">Availability List: <?php echo $_SESSION["loggedUser"]->getUserName()?></h2>
            <table style="text-align:center;">
              <thead>              
                  <tr>
                    <th>Keeper</th>
                  </tr>
              </thead>
              <tbody>
                <?php
                  foreach($keeperList as $keeper){
                    ?>
                      <tr>
                        <td><?php echo $keeper->getUserName() ?></td>
                      </tr>
                    <?php
                  }
                ?>                          
              </tbody>
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