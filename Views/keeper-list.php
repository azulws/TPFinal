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
                <th>FirstName</th>
                <th>LastName</th>
                <th>UserName</th>       
                <th>Remuneration</th>
              </tr>
          </thead>
          <tbody>
            <?php
              foreach($keeperList as $keeper)
              {
                ?>
                  <tr>
                    <td><?php echo $keeper->getFirstName() ?></td>
                    <td><?php echo $keeper->getLastName() ?></td>
                    <td><?php echo $keeper->getUserName() ?></td>
                    <td><?php echo $keeper->getRemuneration() ?></td>
                  </tr>
                <?php
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