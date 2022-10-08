
<?php 
    include_once('header.php');
    include_once('nav-bar.php');
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
        <form action="<?php echo FRONT_ROOT."Beer/Add" ?>" method="post" style="background-color: #EAEDED;padding: 2rem !important;">
          <table> 
            <thead>              
              <tr>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Descripcion</th>
                <th>Dens. Alcohol</th>                
                <th>Precio $ </th>
              </tr>
            </thead>
            <tbody align="center">
              <tr>
                <td style="max-width: 120px;">    
                  <input type="number" name="code" size="22" min="0" required>
                </td>
                <td>
                  <input type="text" name="name" size="22" required>
                </td>
                <td>
                  <select name="beerTypeId" style="margin-top: 3%;min-height: 35px;height: 20px" required>
                    <?php
                      foreach($beerTypeList as $beerType)
                      {
                        ?>
                           <option value="<?php echo $beerType->getId() ?>"><?php echo $beerType->getName() ?></option>
                        <?php
                      }
                    ?>                                
                  </select>
                </td>
                <td>
                  <textarea name="description" cols="60" rows="1"></textarea>
                </td>
                <td>
                  <input type="number" name="density" min="0" style="max-width: 120px" required>
                </td>                
                <td>
                  <input type="number" name="price" min="0" style="max-width: 120px" required>
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
  