<div>
  <main > 
    <!-- main body -->
    <div > 
      <div >
      <table class="blueTable">
          <thead>
          <thead>              
              <tr>
                <th> FirstName</th>
                <th> LastName</th>
                <th> UserName</th>       
                <th> Remuneration</th>
              </tr>
          </thead>
          <tbody>
            <?php
              foreach($keeperList as $keeper)
              {
                ?>
                  <tr>
                    <td><?php echo $keeper->getFirstName() ?> </td>
                    <td><?php echo $keeper->getLastName() ?> </td>
                    <td><?php echo $keeper->getUserName() ?> </td>
                    <td><?php echo $keeper->getRemuneration() ?> </td>
                  </tr>
                <?php
              }
            ?>                          
          </tbody>
        </table>
      </div>
    </div>
    <!-- / main body -->
    <div ></div>
  </main>
</div>

<?php 
  include('footer.php');
?>