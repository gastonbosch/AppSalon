<h1 class="name-page">I forget my password</h1>
<p class="description-page">Reset your password by typing your mail below</p>
<?php include_once __DIR__.'/../templates/alerts.php'; ?>
<form class="form" method="POST" action="/forgetPassword">
    <div class="field">
        <label for="email">Email</label>
        <input type="email" id="email" placeholder="Your e-mail" name="email">
    </div>

    <input type="submit" class="button" value="Send">
</form>

<div class="actions">
    <a href="/">Have you already created an account? Login</a>
    <a href="/createAccount">Do not you have an account yet? Create one</a>
</div>