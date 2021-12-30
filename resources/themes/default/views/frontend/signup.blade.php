<h1>Signup here</h1>
<form action="" method="post" class="general-form">
    @csrf
    <div class="form-group">
        <label>Full Name</label>
        <input type="text" name="val[name]" class="form-control-lg"/>
    </div>
    <div class="form-group">
        <label>Email address</label>
        <input type="text" name="val[email]" class="form-control-lg"/>
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" name="val[password]" class="form-control-lg"/>
    </div>
    <button type="submit" class="btn btn-primary">Sign up</button>
</form>

