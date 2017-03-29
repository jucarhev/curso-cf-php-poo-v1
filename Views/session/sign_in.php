<style>
	body {
    padding-top: 15px;
    font-size: 12px
  }
  .main {
    max-width: 420px;
    margin: 0 auto;
  }
  .login-or {
    position: relative;
    font-size: 18px;
    color: #aaa;
    margin-top: 10px;
    margin-bottom: 10px;
    padding-top: 10px;
    padding-bottom: 10px;
  }
  .span-or {
    display: block;
    position: absolute;
    left: 50%;
    top: -2px;
    margin-left: -25px;
    background-color: #fff;
    width: 50px;
    text-align: center;
  }
  .hr-or {
    background-color: #cdcdcd;
    height: 1px;
    margin-top: 0px !important;
    margin-bottom: 0px !important;
  }
  h3 {
    text-align: center;
    line-height: 300%;
  }
</style>
<div class="container">
  <div class="row">

    <div class="main">

      <h3>Please Log In, or <a href="register">Sign Up</a></h3>

      <form role="form" action="sign_in" method="POST">
        <div class="form-group">
          <label for="inputUsernameEmail">Username or email</label>
          <input type="text" class="form-control" id="inputUsernameEmail" name="username">
        </div>
        <div class="form-group">
          <a class="pull-right" href="#">Forgot password?</a>
          <label for="inputPassword">Password</label>
          <input type="password" class="form-control" id="inputPassword" name="password">
        </div>
        <div class="checkbox pull-right">
          <label>
            <input type="checkbox">
            Remember me </label>
        </div>
        <button type="submit" class="btn btn btn-primary">
          Log In
        </button>
      </form>
    
    </div>
    
  </div>