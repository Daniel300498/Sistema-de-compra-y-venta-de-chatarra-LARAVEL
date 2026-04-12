function togglePassword(fieldId, iconId) {
  const passwordField = document.getElementById(fieldId);
  const toggleIcon = document.getElementById(iconId);

  // Alternar entre 'password' y 'text'
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
