<?php include_once("fixed/header.php")?>
<center>
    <div id="login" class="card">
        <h2>Login</h2><br>
        <form action="authn" method="post">
            <label for="username">Username<span>*</span></label>
            <input type="text" id="username" name="username" placeholder="Username" maxlength="20" required>
            <label for="password">Password<span>*</span></label>
            <input type="password" id="password" name="password" placeholder="Password" maxlength="20" required>
            <center><input type="submit" value="Submit"></center>
        </form>
        <a href="forget" style="color:#666">Forget password</a>
    </div>
</center>
<?php include_once("fixed/footer.php")?>