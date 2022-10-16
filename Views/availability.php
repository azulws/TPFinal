<?php 
    include('header.php');
    include('nav-bar.php');
?>
<div class="wrapper row4">
  <main class="hoc container clear"> 
    <!-- main body -->
    <div class="content"> 
      <div class="scrollable">
        <table style="text-align:center;">
          <thead>
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
                ?>
                  <tr>
                    <td><?php echo $availability->getDate() ?></td>
                    <td><?php echo $availability->getKeeperList() ?></td>
                  </tr>
                <?php
              }
            ?>                          
          </tbody>
        </table>
        </div>
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
        
                <input type="submit" class="btn" value="Confirm" style="background-color:#DC8E47;color:white;"/>
            </div>
            <div>
            </form>
        </div>
    </div>
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>

<?php 
  include('footer.php');
?>