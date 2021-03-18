<?php include_once("fixed/header.php")?>
<center>
    <div id="login" class="card">
        <h2>Forget Password</h2><br>
        <form action="forget" method="post">
            <label for="username">Username<span>*</span></label>
            <input type="text" id="username" name="username" placeholder="Username" maxlength="20" required>
            <label for="email">Email<span>*</span></label>
            <input type="email" id="email" name="email" placeholder="Email" maxlength="50" required>
            <center><input type="submit" value="Submit"></center>
        </form>
    </div>
</center>
<?php include_once("fixed/footer.php")?>