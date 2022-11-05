<div class="wrapper row4">
  <main class="hoc container clear"> 
    <!-- main body -->
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
                  foreach($keeperListCheck as $keeper){
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