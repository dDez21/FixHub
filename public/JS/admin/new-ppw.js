document.addEventListener('DOMContentLoaded', () => {
  const ppwCheckbox = document.getElementById('change-password-toggle');
  const ppwBox = document.getElementById('password-box');
  const ppwText = document.getElementById('password');
  const ppwConfirm = document.getElementById('password_confirmation');
  if (!ppwCheckbox || !ppwBox || !ppwText || !ppwConfirm) return;
  
  function sync() {
    const on = ppwCheckbox.checked;
    ppwBox.hidden = !on;
    ppwText.disabled = !on;
    ppwConfirm.disabled = !on;
    ppwText.required = on;
    ppwConfirm.required = on;
  }
  ppwCheckbox.addEventListener('change', sync);
  sync();
});