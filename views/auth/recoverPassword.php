<h1 class="name-page">Recover Password</h1>
<p class="description-page">Enter your new password</p>
<?php include_once __DIR__.'/../templates/alerts.php'; ?>
<?php if($error) return; ?>
<form class="form" method="POST">
    <div class="field">
        <label for="password">Password</label>
        <input type="password" id="password" placeholder="Your new password" name="password">
    </div>
    <input type="submit" class="button" value="Save new password">
</form>

<div class="actions">
    <a href="/">Have you already created an account? Login</a>
    <a href="/createAccount">Do not you have an account yet? Create 
</div>