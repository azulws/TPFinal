<?php 
    include_once('header.php');
    include_once('nav-bar.php');
?>

<div id="breadcrumb" class="hoc clear"> 
    <h6 class="heading">Ingreso de Owner
    </h6>
  </div>
</div>
<div class="wrapper row3" >
  <main class="container" style="width: 95%;"> 
    <!-- main body -->
    <div class="content" > 
      <div id="comments" style="align-items:center;">
        <h2>Ingresar Datos</h2>
        <form action="<?php echo FRONT_ROOT."Owner/Add" ?>" method="post" style="background-color: #EAEDED;padding: 2rem !important;">
          <table> 
            <thead>              
              <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>User Name</th>
                <th>Password</th>
              </tr>
            </thead>
            <tbody align="center">
              <tr>
                <td style="max-width: 120px;">    
                  <input type="text" name="firstName" size="22" min="0" required>
                </td>
                <td>
                  <input type="text" name="lastName" size="22" required>
                </td>
                
                <td>
                  <input type="text" name="userName" min="0" style="max-width: 120px" required>
                </td>                
                <td>
                  <input type="password" name="password" min="0" style="max-width: 120px" required>
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
  echo "<script> alert('agregado con exito')";
  echo "window.location: '../home.php';</script>";
?>


<?php 
    include_once('footer.php');
?>
  