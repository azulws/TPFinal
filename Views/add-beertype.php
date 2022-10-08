
<?php 
include_once('header.php');
include_once('nav-bar.php');
?>

<div id="breadcrumb" class="hoc clear"> 
    <h6 class="heading">Ingreso de Tipos Cervezas</h6>
  </div>
</div>
<div class="wrapper row3" >
  <main class="container" style="width: 90%;"> 
    <!-- main body -->
    <div class="content" > 
      <div id="comments" style="align-items:center;">
        <h2>Ingresar Tipo de Cerveza</h2>
        <form action="<?php echo FRONT_ROOT."BeerType/Add" ?>" method="post"  style="background-color: #EAEDED;padding: 2rem !important;">
          <table> 
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Descripción</th>
              </tr>
            </thead>
            <tbody align="center">
              <tr>
               <td>
                  <input type="text" name="name" value="" size="22" required>
                </td>
                <td>
                  <textarea name="description" id="" cols="50" rows="1" required></textarea>
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
  