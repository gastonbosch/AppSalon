<h1 class="name-page">Create Account</h1>
<p class="description-page">Fill out the form bellow to create a account</p>
<?php include_once __DIR__.'/../templates/alerts.php'; ?>
<form class="form" method="POST" action="/createAccount">
    <div class="field">
        <label for="name">Name</label>
        <input type="text" id="name" placeholder="Your name" name="name" value="<?php echo s($user->name); ?>">
    </div>
    <div class="field">
        <label for="surname">Surname</label>
        <input type="text" id="surname" placeholder="Your surname" name="surname" value="<?php echo s($user->surname); ?>">
    </div>
    <div class="field">
        <label for="telephone">Telephone</label>
        <input type="tel" id="telephone" placeholder="Your telephone" name="telephone" value="<?php echo s($user->telephone); ?>">
    </div>
    <div class="field">
        <label for="email">Email</label>
        <input type="email" id="email" placeholder="Your e-mail" name="email" value="<?php echo s($user->email); ?>">
    </div>

    <div class="field">
        <label for="password">Password</label>
        <input type="password" id="password" placeholder="Your password" name="password">
    </div>
    <input type="submit" class="button" value="Create Account">
</form>

<div class="actions">
    <a href="/">Have you already created an account? Login</a>
    <a href="/forgetPassword">Did you forget you password?</a>
</div>