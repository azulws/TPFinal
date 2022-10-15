<?php 
    include_once('header.php');
    include_once('nav-bar.php'); 
?>
<head>
    <link rel="stylesheet" href="Views/css/style.css">

</head>
<main class="main">

  
    <div>
        <h1 align="center">WELCOME</h1>
    </div>
  
    <div align="center">
        <form action="<?php echo FRONT_ROOT . "Home/Login"?>" method="post">
            <div>
                <label for="user_name">
                    <span>UserName</span>
                    <input  type="text" id="userName" name="userName" required>
                </label>
            </div>
            <div>
                <label for="user_password">
                    <span>Password</span>
                    <input type="password" id="password" name="password" required>
                </label>
            </div>
            <div>
                <label for="user_type">
                    <span>UserType</span>
                    <select name="userType" id="userType" require>
                        <option value="owner">Owner</option>
                        <option value="keeper">Keeper</option>
                    </select>
                </label>
            </div>
            <div>
                <button class="btn-encriptar" type="submit" class="btn">Login</button>
            </div>
            <div>
                <a class="btn-desencriptar" href="<?php echo FRONT_ROOT."Home/ShowAddView" ?>">Registrarse</a>
            </div>
        </form>
    </div>
    <div id="pageintro" class="hoc clear"> 
    <article class="center">
      <h3 class="heading underline">Los mejores en cuidado de mascotas</h3>
     <!-- <footer><a class="btn" href="#">Conocer Mas</a></footer> -->
    </article>
  </div>
</main>

<?php 
  include_once('footer.php');
?> 
</div>