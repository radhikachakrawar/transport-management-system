document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("nav-login-signup").addEventListener("click", function() {
      window.location.href = "http://localhost/Transportation%20MS//login-signup.php";
    });
});



document.addEventListener("DOMContentLoaded", function() {
  document.getElementsByClassName("btn btn-primary btn-lg btn-block").addEventListener("click", function() {
    window.location.href = "http://localhost/Transportation%20MS/logout.php";
  });
});

document.addEventListener("DOMContentLoaded", function() {
  document.getElementById("admin-login").addEventListener("click", function() {
    window.location.href = "http://localhost/Transportation%20MS/admins/login.php";
  });
});

