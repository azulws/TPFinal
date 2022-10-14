
<div class="bgded overlay" style="background-image:url('<?php echo IMG_PATH; ?>FlamingMoeHome.jpg');"> 

  <div class="wrapper row1">
    <header id="header" class="hoc clear"> 
      <div id="logo" class="fl_left">
        <h1><a href="#">Pet Hero</a></h1>
      </div>
      <!-- Add path routes below -->
      <nav id="mainav" class="fl_right">
        <ul class="clear">
            <li class="active"><a href="<?php echo FRONT_ROOT ?>">Menu Principal</a></li>
            <li><a class="drop" href="#">Owner</a>
              <ul>
                <li><a href="<?php echo FRONT_ROOT."Owner/ShowAddView" ?>">Registrarse</a></li>
                <li><a href="<?php echo FRONT_ROOT."Owner/ShowLoginView" ?>">Loguearse</a></li>
              </ul>
            </li>
            <li><a class="drop" href="#">Keeper</a>
              <ul>
                <li><a href="<?php echo FRONT_ROOT."Keeper/ShowAddView" ?>">Registrarse</a></li>
                <li><a href=<?php echo FRONT_ROOT."Keeper/ShowLoginView" ?>>Loguearse</a></li>
              </ul>
            </li>
        </ul>
    </nav> 
    </header>
  </div>