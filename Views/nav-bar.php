
<div class="bgded overlay" style="background-image:url('<?php echo IMG_PATH; ?>FlamingMoeHome.jpg');"> 
  <div class="wrapper row0">
    <div id="topbar" class="hoc clear">   
      <div class="fl_right">     
        <ul class="nospace">
          <li><i class="fas fa-phone"></i> (123) 456 7890</li>
          <li><i class="far fa-envelope"></i> FlamingMoe@beer.com</li>
        </ul>
      </div>
    </div>
  </div>

  <div class="wrapper row1">
    <header id="header" class="hoc clear"> 
      <div id="logo" class="fl_left">
        <h1><a href="#">Cervezas Artesanales</a></h1>
      </div>
      <!-- Add path routes below -->
      <nav id="mainav" class="fl_right">
        <ul class="clear">
            <li class="active"><a href="<?php echo FRONT_ROOT ?>">Menu Principal</a></li>
            <li><a class="drop" href="#">Owner</a>
              <ul>
                <li><a href="<?php echo FRONT_ROOT."Owner/ShowAddView" ?>">Agregar</a></li>
                <li><a href="<?php echo FRONT_ROOT."Beer/ShowListView" ?>">Ver Listado</a></li>
              </ul>
            </li>
            <li><a class="drop" href="#">Tipos de Cervezas</a>
              <ul>
                <li><a href="<?php echo FRONT_ROOT."BeerType/ShowAddView" ?>">Agregar</a></li>
                <li><a href=<?php echo FRONT_ROOT."BeerType/ShowListView" ?>>Ver Listado</a></li>
              </ul>
            </li>
        </ul>
    </nav> 
    </header>
  </div>