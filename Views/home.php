<main class="main">
    <div align="center">
    <div > 
    <?php if ($message and $message !="logOut") { ?>
      <span class="bar error" style="font-size: 30px"> <?php echo $message; ?> </span>
      <?php
    } 
    ?>
    </div>
        <br>
        <h1 align="center">WELCOME</h1>
    </div>
  <br>
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
             <br>
             <br>
             <br>
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
            <br>
            <div>
                <a class="btn-desencriptar" href="<?php echo FRONT_ROOT."Home/ShowAddView" ?>">Register</a>
            </div>
        </form>
    </div>
    <section class="message-box">
      <div class="cat">
        <?php 
          if($message!="logOut"){
        ?>
        <img class= "monigote" src="<?php echo IMG_PATH."keeper.jpg"?>">
        <?php 
          }else{ 
        ?>
        <img class= "monigote" src="<?php echo "../Views/img/keeper.jpg"?>">
        <?php 
          } 
        ?>
      </div>
        <h2>Los mejores cuidando mascotas!</h2>
        <h3>Por favor especifique que tipo de usuario es a la hora de entrar.</h3>
    </section>
</main>

