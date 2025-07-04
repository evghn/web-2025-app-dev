<div>
    Регистрация
</div>
<form action="" method="post">

    <div>
        <label>name:
            <input type="text" name="name" value="<?= $model->name ?>" required></label>
    </div>
    <div><label>login: <input type="text" name="login" value="<?= $model->login ?>" required></label></div>
    <div><label>password: <input type="text" name="password" value="" required></label></div>

    <button type="submit">Регистрация</button>
</form>