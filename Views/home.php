<?php
 include_once('header.php');
 ?>

<main class="main">
    <div>
        <h1 align="center">WELCOME</h1>
    </div>
  
    <div align="center">
        <form action="<?php echo FRONT_ROOT . "Home/Login"?>" method="post">
             
            <div class="form__group">
              <input type="text" class="form__input" id="userName" name="userName" placeholder="User name" required />
              <label for="userName" class="form__label">User Name</label>
            </div>

        
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
</main>

<?php include_once('footer.php');?> 
