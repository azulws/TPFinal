<?php
 include_once('header.php');
 ?>
 <head>

 <link href="<?php echo CSS_PATH;?>style.css" rel="stylesheet" type="text/css"   media="all">
</head>

<div class="container">
  <div class="card">
    <div class="header">
      <h3>Menu Owner <i class="fas fa-angle-down iconM"></i></h3>
    </div>
    <div class="body">
      <ul>
        <li><a href="<?php echo FRONT_ROOT . "Keeper/ShowListView"?>">KEEPER LIST</a></li>
        <li><a href="<?php echo FRONT_ROOT . "Pet/ShowAddView"?>" >ADD PET</a></li>
        <li><a href="<?php echo FRONT_ROOT . "Pet/ShowListView"?>">MY PETS</a></li></li>
      </ul>
    </div>
  </div>
</div>