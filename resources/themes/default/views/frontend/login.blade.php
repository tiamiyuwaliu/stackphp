<h2>Login form</h2>
<form action="" method="post" class="general-form">
    @csrf
    <div class="form-group">
        <label>Email address</label>
        <input type="text" name="val[email]" class="form-control-lg"/>
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" name="val[password]" class="form-control-lg"/>
    </div>
    <button type="submit" class="btn btn-primary">Log in</button>
</form>
