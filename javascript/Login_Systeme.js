const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');
const signup = document.getElementsByClassName('sign-up');
const signin = document.getElementsByClassName('sign-in');

registerBtn.addEventListener('click', () => {
    container.classList.add("active");
    signin.classList.add("d-none");
});

loginBtn.addEventListener('click', () => {
    container.classList.remove("active");
    signup.classList.add("d-none");
});

document.addEventListener("DOMContentLoaded", function () {
  const togglePassword = document.querySelector("#togglePassword");
  const passwordInput = document.querySelector("#passwordInput");

  togglePassword.addEventListener("click", function () {
    const type =
      passwordInput.getAttribute("type") === "password" ? "text" : "password";
    passwordInput.setAttribute("type", type);

    this.classList.toggle("fa-eye");
    this.classList.toggle("fa-eye-slash");
  });
});