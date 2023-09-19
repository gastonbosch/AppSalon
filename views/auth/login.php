<h1 class="name-page">Login</h1>
<p class="description-page">Login with your data</p>
<?php include_once __DIR__.'/../templates/alerts.php'; ?>
<form class="form" method="POST" action="/">
    <div class="field">
        <label for="email">Email</label>
        <input type="email" id="email" placeholder="Your e-mail" name="email">
    </div>

    <div class="field">
        <label for="password">Password</label>
        <input type="password" id="password" placeholder="Your password" name="password">
    </div>

    <input type="submit" class="button" value="Login">
</form>

<div class="actions">
    <a href="/createAccount">Do not you have an account yet? Create one</a>
    <a href="/forgetPassword">Did you forget you password?</a>
</div>