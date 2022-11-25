
<main class="main"> 
    <!-- main body -->
    <div > 
      <div align="center">
        <form action="<?php echo FRONT_ROOT."Owner/Add" ?>" method="post" >
                <h3><?php if(isset($message)){
                  echo $message;
                } ?></h3>
                <div class="form__group">
                  <input class="form__input" type="text"  name="firstName" size="22" min="0" placeholder="First name" required />
                  <label for="firstName" class="form__label">First name</label>
                </div>
                <div class="form__group">
                  <input class="form__input" type="text" name="lastName" size="22" placeholder="Last name" required/>
                  <label for="lastName" class="form__label">Last name</label>
                </div>
                <div class="form__group">
                  <input class="form__input" type="text" name="userName" min="0" placeholder="User name" required>
                  <label for="userName" class="form__label">User name</label>
                </div>
                <div class="form__group">
                  <input class="form__input" type="email" name="email" min="0" placeholder="Email" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" required>
                  <label for="email" class="form__label">Email</label>
                </div>                   
                <div class="form__group">
                  <input class="form__input" type="password" name="password" min="0" placeholder="Password" required>
                  <label for="password" class="form__label">Password</label>
                </div>            
          <div align="center">
            <input type="submit" class="btn-encriptar" value="Owner" />
          </div>
          <br>
          <div align="center">
            <input type="submit" class="btn-desencriptar" value="Keeper"  formaction="<?php echo FRONT_ROOT."Keeper/Add" ?>">
          </div>
        </form>
      </div>
   

    <div class="clear"></div>
  </main>
<?php
  echo "<script> alert('agregado con exito')";
  echo "window.location: '../home.php';</script>";
?>


<?php 
    include_once('footer.php');
?>
  