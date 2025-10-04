<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login MBG</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <style>
    body {
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background: linear-gradient(135deg, #9AA59C, #DDDFC2); /* Morning Blue → Bone */
    }
    .login-box {
      width: 380px;
      padding: 30px;
      border-radius: 20px;
      background: rgba(255, 255, 255, 0.25);
      backdrop-filter: blur(15px);
      box-shadow: 0 8px 32px rgba(0,0,0,0.2);
      color: #2C341B; /* Pine Tree */
      position: relative;
    }
    .login-icon {
      width: 90px;
      height: 90px;
      border-radius: 50%;
      background: #9AA59C; /* Morning Blue */
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 40px;
      color: #DDDFC2; /* Bone */
      position: absolute;
      top: -45px;
      left: 50%;
      transform: translateX(-50%);
    }
    .form-control {
      background: rgba(255,255,255,0.3);
      border: none;
      color: #2C341B;
    }
    .form-control::placeholder { color: #2C341B; }
    .btn-login {
      background: #97AC82; /* Olivine */
      border: none;
      width: 100%;
      padding: 12px;
      border-radius: 25px;
      font-weight: bold;
      color: #fff;
    }
    .btn-login:hover {
      background: #688A65; /* Russian Green */
    }
    .extra {
      font-size: 14px;
      margin-top: 10px;
      display: flex;
      justify-content: space-between;
    }
    .extra a {
      color: #2C341B;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="login-box">
    <div class="login-icon">
      <i class="fa fa-user"></i>
    </div>
    <h4 class="text-center mt-5 mb-4">Login MBG</h4>

    <form id="loginForm" action="/login/auth" method="post">
      <div class="mb-3 input-group">
        <span class="input-group-text bg-transparent border-0 text-dark">
          <i class="fa fa-envelope"></i>
        </span>
        <input type="text" name="email" class="form-control" placeholder="Email" required>
      </div>
      <div class="mb-3 input-group">
        <span class="input-group-text bg-transparent border-0 text-dark">
          <i class="fa fa-lock"></i>
        </span>
        <input type="password" name="password" class="form-control" placeholder="Password" required>
      </div>
      <button type="submit" class="btn-login">LOGIN</button>
    </form>

    <div class="extra">
      <div><input type="checkbox"> Remember me</div>
      <a href="#">Forgot Password?</a>
    </div>
  </div>
</body>
</html>
