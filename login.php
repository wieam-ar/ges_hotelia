<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Page</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <link
    href="https://fonts.googleapis.com/icon?family=Material+Icons"
    rel="stylesheet" />
  <link rel="stylesheet" href=" ./styles/login.css" />
</head>

<body>
  <div class="container row p-0 mx-auto" id="container">
    <div class="form-container sign-in">
      <h2 class="welcome-back">Welcome Back, User !</h2>
      <p class="welcome-msj"> Enter Login Details</p>


      <div class="divider mt-4">or</div>

      <form class="mt-4" action="loginiw.php" method="post">
        <div class="mb-3">
          <input type="email" id="email" name="email" class="inputs" placeholder="Email Address" />
        </div>
        <div class="mb-3 position-relative">
          <input
            type="password"
            class="inputs"
            placeholder="Password"
            name="password"
            id="password" />
          <i
            class="fas fa-eye position-absolute end-0 top-50 translate-middle-y me-3"
            style="cursor: pointer; font-size: 10px"
            id="togglePassword"></i>
        </div>
        <div class="d-flex justify-content-between mb-3">
          <div
            class="d-flex justify-content-center align-items-center text-center">
            <input type="checkbox" name="remember" id="remember" />
            <label for="remember" class="remember ms-1">Remember me</label>
          </div>
          <a href=" forget_password.php" class=" create-acc" style="color: #c89e52;">Forgot Password?</a>
        </div>
        <button type="submit" class="btn text-light  login mt-5" style="background-color: #c89e52;">
          Log In
        </button>
      </form>
      <p class="mt-3 create-acc">
        Don’t have an account?
        <a href="#sign-up" class=" create-acc" style="color: #c89e52;">Create account</a>
      </p>
    </div>
    <!-- signup -->

    <div class="form-container sign-up" id="sign-up" style="padding: 20px;">
      <h2 class="welcome-back">Join Us Today! </h2>
      <p class="welcome-msj">Sign up for free and access exclusive features!</p>


      <div class="divider mt-4">or</div>

      <form class="mt-2" action="register.php" method="post">
        <div class="mb-2">
          <input type="text" id="nom" name="nom" class="inputs" placeholder="nom" style="padding: 4px;" />
        </div>
        <div class="mb-2">
          <input type="email" class="inputs" id="email" name="email" placeholder="Email Address" style="padding: 4px;" />
        </div>
       
        <div class="mb-2">
          <input type="tel" name="telephone" id="telephone" class="inputs" placeholder="téléphone" pattern="[0-9]{10}" style="padding: 4px;" required>
        </div>
        <div class="mb-2">
          <textarea name="adresse" id="adresse" class="inputs" placeholder="adresse" style="padding:3px;"></textarea>
        </div>

        <div class="mb-2 position-relative">
          <input type="password" class="inputs" name="password" placeholder="Password" id="passwordInput" />
          <i class="fas fa-eye position-absolute end-0 top-50 translate-middle-y me-3" style="cursor: pointer; font-size: 10px" id="togglePassword"></i>
        </div>
        <div class="d-flex justify-content-between mb-3">
          <div class="d-flex justify-content-center align-items-center text-center">
            <input type="checkbox" id="remember" />
            <label for="remember" class="remember ms-1">Remember me</label>
          </div>
        </div>
        <button type="submit" class="btn login mt-2 text-light" style="background-color: #c89e52;">
          Sign up
        </button>
      </form>

      <p class="mt-3 create-acc">
        Already have an account?
        <a href="#" class=" create-acc" style="color: #c89e52;">Log in here.</a>
      </p>
    </div>
    <div class="toggle-container">
      <div class="toggle">
        <div class="toggle-panel toggle-left" style="background-image:url(./pictures/image.png); background-size: cover;  background-repeat: no-repeat; ">
          <h1>Welcome Back!</h1>
          <p>Enter your personal details to use all of site features</p>
          <div
            class="d-flex justify-content-center align-items-center text-center">
            <button class="hidden google-btn text-light px-4" id="login">Sign In</button>
          </div>
        </div>
        <div class="toggle-panel toggle-right" style="background-image:url(./pictures/image.png); background-size: cover;  background-repeat: no-repeat; ">
          <h1>Hello, Friend!</h1>
          <p>
            Register with your personal details to use all of site features
          </p>
          <div
            class="d-flex justify-content-center align-items-center text-center">
            <button class="hidden google-btn text-light px-4" id="register">Sign Up</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="./javascript/Login_Systeme.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>