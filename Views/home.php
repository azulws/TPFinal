<?php 
    include_once('header.php');
    include_once('nav-bar.php'); 
?>

<main class="main">

  
    <div>
        <h1 align="center">WELCOME</h1>
    </div>
  
    <div align="center">
        <form action="<?php echo FRONT_ROOT . "Home/Login"?>" method="post">
            <div>
                <!--<label for="user_name">
                    <span>UserName</span>
                    <input  type="text" id="userName" name="userName" required>
                </label>-->
            </div> 
            <div class="form__group">
              <input type="text" class="form__input" id="userName" name="userName" placeholder="User name" required />
              <label for="userName" class="form__label">User Name</label>
            </div>

            <!--<div>
                <label for="user_password">
                    <span>Password</span>
                    <input type="password" id="password" name="password" required>
                </label>
            </div>-->
             <div class="form__group">
              <input type="password" class="form__input" id="password" name="password" placeholder="Password" required />
              <label for="password" class="form__label">Password</label>
             </div>

              <div class="box">
                <label for="user_type">
                    <span>UserType</span>
                    <select name="userType" id="userType" require>
                        <option style="background-color: #004882;" value="owner">Owner</option>
                        <option style="background-color: #004882;" value="keeper">Keeper</option>
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

    <section class="message-box">

      <div class="cat">
         <img class= "monigote" src="Views/img/keeper.jpg">
      </div>
       
        <h2>Los mejores cuidando mascotas!</h2>
        <h3>Por favor especifique que tipo de usuario es a la hora de entrar.</h3>
     
      
    </section>

    <div id="pageintro" class="hoc clear"> 
      <article class="center">
       <!-- <h3 class="heading underline">Los mejores en cuidado de mascotas</h3>
       <footer><a class="btn" href="#">Conocer Mas</a></footer> -->
      </article>
    </div>
</main>

<?php include_once('footer.php');?> 
