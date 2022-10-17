<?php 
    include('header.php');
    include('nav-bar.php');
?>
<div class="wrapper row4">
  <main class="hoc container clear"> 
    <!-- main body -->
    <div class="content"> 
        <div id="comments" style="align-items:center;">
            <h2 align="center">Insert New Availability</h2>
            <form align="center" action="<?php echo FRONT_ROOT."Availability/Add" ?>" method="post" style="background-color: #EAEDED;padding: 2rem !important;" enctype="multipart/form-data">
            <table align="center"> 
                <thead>              
                <tr>
                    <th>Date:</th>
                </tr>
                </thead>
                <tbody align="center">
                <tr>
                    <td style="max-width: 120px;">
                    <input type="date" name="date" required>
                    </td>
                </tr>
                </tbody>
            </table>
            <div>
                <input type="hidden" name="user" value="<?php echo $_SESSION["loggedUser"]->getUserName() ?>">
                <input type="submit" class="btn" value="Confirm" style="background-color:#DC8E47;color:white;"/>
            </div>
            <div>
            </form>
        </div>
        <div class="scrollable">
        <h2 align="center">Availability List: <?php echo $_SESSION["loggedUser"]->getUserName()?></h2>
        <table style="text-align:center;">
          <thead>              
              <tr>
                <th>Date</th>
                <th>Keeper</th>
              </tr>
          </thead>
          <tbody>
            <?php
              foreach($availabilityList as $availability)
              {
                echo var_dump($availability);
                if($availability->getKeeperList()== $_SESSION["loggedUser"]->getUserName()){
                ?>
                  <tr>
                    <td><?php echo $availability->getDate() ?></td>
                    <td><?php echo $availability->getKeeperList() ?></td>
                  </tr>
                <?php
                }
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