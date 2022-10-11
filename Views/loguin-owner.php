<main>
    <div>
        <h1>WELCOME</h1>
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