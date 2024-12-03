document.getElementById('toggleForm').addEventListener('click', function() {
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    const isRegistering = registerForm.style.display === 'none';
  
    loginForm.style.display = isRegistering ? 'none' : 'block';
    registerForm.style.display = isRegistering ? 'block' : 'none';
    this.textContent = isRegistering ? 'Login' : 'Registrar';
  });
  
  document.getElementById('forgotPassword').addEventListener('click', function(e) {
    e.preventDefault();
    alert('Recuperação de senha não implementada.');
  });
  
  document.getElementById('googleLogin').addEventListener('click', function() {
    window.location.href = 'https://accounts.google.com/signin';
  });
  
  document.getElementById('facebookLogin').addEventListener('click', function() {
    window.location.href = 'https://www.facebook.com/login';
  });

  // Exemplo de backend_simulation.js

// Supondo que você esteja passando essa variável a partir do backend
var isOwnProfile = false; // Defina isso conforme necessário

// Este script deve ser incluído antes do uso da variável no HTML
document.addEventListener('DOMContentLoaded', function() {
    if (!isOwnProfile) {
        document.getElementById('addFriend').style.display = 'block';
    } else {
        document.getElementById('addFriend').style.display = 'none';
    }
});
  