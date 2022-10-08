<?php 
    include_once('header.php');
?>

<div id="breadcrumb" class="hoc clear"> 
    <h6 class="heading">Ingreso de Cervezas</h6>
  </div>
</div>
<div class="wrapper row3" >
  <main class="container" style="width: 95%;"> 
    <!-- main body -->
    <div class="content" > 
      <div id="comments" style="align-items:center;">
        <h2>Ingresar Cerveza</h2>
        <form action="<?php echo FRONT_ROOT."Keeper/Add" ?>" method="post" style="background-color: #EAEDED;padding: 2rem !important;">
          <table> 
            <thead>              
              <tr>
                <th>idKeeper</th>
                <th>FirstName</th>
                <th>LastName</th>
                <th>UserName</th>
                <th>Password</th>                
                <th>Remuneration</th>
                <th>Reputacion</th>
              </tr>
            </thead>
            <tbody align="center">
              <tr>
                <td style="max-width: 120px;">    
                  <input type="text" name="idKeeper" required>
                </td>
                <td>
                  <input type="text" name="firstName" required>
                </td>
                <td>
                  <select type "text" name="lastName" required>
                </td>
                <td>
                  <textarea type="text" name="userName"></textarea>
                </td>
                <td>
                  <input type="text" name="password" required>
                </td>                
                <td>
                  <input type="double" name="remuneration" required>
                </td>
                <td>
                  <input type="double" name="reputacion" required>
                </td>                  
              </tr>
              </tbody>
          </table>
          <div>
            <input type="submit" class="btn" value="Agregar" style="background-color:#DC8E47;color:white;"/>
          </div>
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
  