<?php
/** @var array $data data fot view */
?>
<h1>Authentication</h1>
<form class="auth-form" action="/auth" method="post">
    <label>
        Login:
        <input class="input auth-form__input" type="text" name="login">
    </label>

    <label>
        Password:
        <input class="input auth-form__input" type="password" name="password">
    </label>
    <?php if ($data['error']): ?>
        <p class="auth-form__error"><?=$data['error']?></p>
    <?php endif; ?>
    <button class="button auth-form__button">Login</button>
</form>
