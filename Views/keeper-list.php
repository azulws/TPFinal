<div>
  <main > 
    <!-- main body -->
    <div > 
      <div >
      <form action="<?php echo FRONT_ROOT."Chat/ShowChatView" ?>" method="">
      <table class="customTable">
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
                    <td><?php echo $keeper->getRemuneration() ?></td>
                    <td>
                      <input type="hidden" name="isKeeper" value=True>  
                      <input type="hidden" name="owner" value="<?php echo $_SESSION["loggedUser"]->getIdOwner() ?>">  
                      <button type="submit" name="keeper" class="btn" value="<?php echo $keeper->getIdKeeper() ?>"> Chat </button>
                    </td>
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