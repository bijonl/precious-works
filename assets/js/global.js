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

    const header = document.getElementById('site-header');

    function handleScroll() {
        if (window.scrollY > 1) {
        header.classList.add('is-sticky');
        } else {
        header.classList.remove('is-sticky');
        }
    }

    window.addEventListener('scroll', handleScroll);
});