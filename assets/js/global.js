document.addEventListener('DOMContentLoaded', function () {
  const toggleButton = document.querySelector('.menu-toggle');
  const menu = document.getElementById('primary-menu');
  console.log('here'); 

  if (toggleButton && menu) {
    toggleButton.addEventListener('click', function () {
      const expanded = this.getAttribute('aria-expanded') === 'true';
      this.setAttribute('aria-expanded', !expanded);
      menu.classList.toggle('open');
    });
  }
});