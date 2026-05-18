function togglePassword(fieldId, iconId) {
  const passwordField = document.getElementById(fieldId);
  const toggleIcon = document.getElementById(iconId);

  if (passwordField.type === 'password') {
      passwordField.type = 'text';
      toggleIcon.classList.remove('bi-eye');
      toggleIcon.classList.add('bi-eye-slash');
  } else {
      passwordField.type = 'password';
      toggleIcon.classList.remove('bi-eye-slash');
      toggleIcon.classList.add('bi-eye');
  }
}
 window.togglePassword = function(fieldId, iconId) {
    const passwordField = document.getElementById(fieldId);
    const toggleIcon = document.getElementById(iconId);

    if (!passwordField || !toggleIcon) return;

    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        toggleIcon.classList.remove('bi-eye');
        toggleIcon.classList.add('bi-eye-slash');
    } else {
        passwordField.type = 'password';
        toggleIcon.classList.remove('bi-eye-slash');
        toggleIcon.classList.add('bi-eye');
    }
};

$(document).ready(function () {
    function analizarPassword(password) {
        let score = 0;
        if (password.length >= 8) score++;
        if (password.length >= 12) score++;
        if (/[a-z]/.test(password)) score++;
        if (/[A-Z]/.test(password)) score++;
        if (/[0-9]/.test(password)) score++;
        if (/[^A-Za-z0-9]/.test(password)) score++;
        return score;
    }

    function validarPassword() {
        const password = $('#new_password').val();
        const confirmPassword = $('#new_password_confirmation').val();
        const score = analizarPassword(password);
        const bar = $('#passwordStrengthBar');
        const text = $('#passwordStrengthText');
        bar.removeClass('bg-danger bg-warning bg-info bg-success');
        if (password.length === 0) {
            bar.css('width', '0%');
            text.html('');
        } else if (score <= 2) {
            bar.css('width', '30%').addClass('bg-danger');
            text.html('Contraseña débil: usa mínimo 8 caracteres, mayúsculas, números y símbolos.').css('color', 'red');
        } else if (score <= 4) {
            bar.css('width', '65%').addClass('bg-warning');
            text.html('Contraseña media: puedes mejorarla agregando símbolos o más caracteres.').css('color', '#b8860b');
        } else {
            bar.css('width', '100%').addClass('bg-success');
            text.html('Contraseña segura.').css('color', 'green');
        }
        if (confirmPassword.length > 0) {
            if (password === confirmPassword) {
                $('#passwordMatch').html('Las contraseñas coinciden.').css('color', 'green');
            } else {
                $('#passwordMatch').html('Las contraseñas no coinciden.').css('color', 'red');
            }
        } else {
            $('#passwordMatch').html('');
        }
    }
    $('#new_password, #new_password_confirmation').on('input', validarPassword);
});
