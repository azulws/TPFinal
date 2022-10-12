<?php 
    include_once('header.php');
    include_once('nav-bar.php'); 
?>

<main>
    <div>
        <h1>WELCOME</h1>
    </div>
    <div id="pageintro" class="hoc clear"> 
    <article class="center">
      <h3 class="heading underline">Los mejores en cuidado de mascotas</h3>
      <footer><a class="btn" href="#">Conocer Mas</a></footer>
    </article>
  </div>
    <div>
        <form action="<?php echo FRONT_ROOT . "Owner/Login"?>" method="post">
            <div>
                <label for="user_name">
                    <span>UserName</span>
                    <input type="text" id="userName" name="userName" required>
                </label>
            </div>
            <div>
                <label for="user_password">
                    <span>Password</span>
                    <input type="password" id="password" name="password" required>
                </label>
            </div>
            <div>
                <button type="submit" class="btn">Login</button>
            </div>
        </form>
    </div>
</main>

<?php 
  include_once('footer.php');
?> 