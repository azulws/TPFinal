
<?php 
  include_once('header.php');
  include_once('nav-bar.php');
?>

<div id="breadcrumb" class="hoc clear"> 
    <h6 class="heading">Listado de Cervezas</h6>
  </div>
</div>
<div class="wrapper row3">
  <main class="hoc container clear"> 
    <!-- main body -->
    <div class="content"> 
      <div class="scrollable">
          <table style="text-align:center;">
            <thead>
              <tr>
                <th style="width: 100px;">Codigo</th>
                <th style="width: 170px;">Nombre</th>
                <th style="width: 120px;">Tipo</th>
                <th style="width: 400px;">Descripcion</th>
                <th style="width: 110px;">Dens. Alcohol</th>                
                <th style="width: 120px;">Precio $ </th>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach($beerList as $beer)
                {
                  ?>
                    <tr>
                      <td><?php echo $beer->getCode() ?></td>
                      <td><?php echo $beer->getName() ?></td>
                      <td><?php echo $beer->getBeerType()->getName() ?></td>
                      <td><?php echo $beer->getDescription() ?></td>
                      <td><?php echo $beer->getDensity() ?></td>
                      <td><?php echo $beer->getPrice() ?></td>
                    </tr>
                  <?php
                }
              ?>                           
            </tbody>
          </table>
          <form action="<?php echo FRONT_ROOT."Beer/Remove" ?>" method="post">
            <table style="max-width: 35%;" >
            <thead>
              <tr>
                <th style="width: 100px;">Codigo</th>
                <th style="width: 170px;">Accion</th>
              </tr>
            </thead>
            <tbody align=center>
              <tr>
                <td>
                  <input type="number" name="code" style="height: 40px;" min="0">  
                </td>
                <td>
                  <button type="submit" class="btn" value="">Remover</button>
                </td>
              </tr>
            </tbody>
            </tr>
          </table>
          <form>
      </div>
    </div>
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>

<?php 
  include_once('footer.php');
?>
  