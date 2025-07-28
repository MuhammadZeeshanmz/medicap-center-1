/**
 * Main - Front Pages
 */
'use strict';

window.isRtl = window.Helpers.isRtl();
window.isDarkStyle = window.Helpers.isDarkStyle();

(function () {
  const menu = document.getElementById('navbarSupportedContent'),
    nav = document.querySelector('.layout-navbar'),
    navItemLink = document.querySelectorAll('.navbar-nav .nav-link');

  // Init custom option check
  setTimeout(function () {
    if (window.Helpers?.initCustomOptionCheck) {
      window.Helpers.initCustomOptionCheck();
    }
  }, 1000);

  if (typeof Waves !== 'undefined') {
    Waves.init();
    Waves.attach(".btn[class*='btn-']:not([class*='btn-outline-']):not([class*='btn-label-'])", ['waves-light']);
    Waves.attach("[class*='btn-outline-']");
    Waves.attach("[class*='btn-label-']");
    Waves.attach('.pagination .page-item .page-link');
  }

  // Init BS Tooltip
  const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });

  // If layout is RTL add .dropdown-menu-end
  if (window.isRtl) {
    Helpers._addClass('dropdown-menu-end', document.querySelectorAll('#layout-navbar .dropdown-menu'));
    Helpers._addClass('dropdown-menu-end', document.querySelectorAll('.dropdown-menu'));
  }

  // Scroll effects
  if (nav) {
    window.addEventListener('scroll', () => {
      if (window.scrollY > 10) {
        nav.classList.add('navbar-active');
      } else {
        nav.classList.remove('navbar-active');
      }
    });

    window.addEventListener('load', () => {
      if (window.scrollY > 10) {
        nav.classList.add('navbar-active');
      } else {
        nav.classList.remove('navbar-active');
      }
    });
  }

  // Mobile menu logic
  function closeMenu() {
    if (menu) menu.classList.remove('show');
  }

  document.addEventListener('click', function (event) {
    if (menu && !menu.contains(event.target)) {
      closeMenu();
    }
  });

  navItemLink.forEach(link => {
    link.addEventListener('click', event => {
      if (!link.classList.contains('dropdown-toggle')) {
        closeMenu();
      } else {
        event.preventDefault();
      }
    });
  });

  // Mega dropdown
  const megaDropdown = document.querySelectorAll('.nav-link.mega-dropdown');
  if (megaDropdown.length) {
    megaDropdown.forEach(e => {
      if (typeof MegaDropdown !== 'undefined') {
        new MegaDropdown(e);
      }
    });
  }

  // Style Switcher
  let styleSwitcher = document.querySelector('.dropdown-style-switcher');
  let storedStyle =
    localStorage.getItem('templateCustomizer-' + templateName + '--Style') ||
    (window.templateCustomizer?.settings?.defaultStyle ?? 'light');

  if (window.templateCustomizer && styleSwitcher) {
    let items = [].slice.call(styleSwitcher.children[1]?.querySelectorAll('.dropdown-item') || []);
    items.forEach(item => {
      item.addEventListener('click', function () {
        let currentStyle = this.getAttribute('data-theme');
        window.templateCustomizer.setStyle(currentStyle || 'light');
      });
    });

    const styleSwitcherIcon = styleSwitcher.querySelector('i');
    if (styleSwitcherIcon) {
      if (storedStyle === 'light') {
        styleSwitcherIcon.classList.add('ti-sun');
        new bootstrap.Tooltip(styleSwitcherIcon, { title: 'Light Mode' });
      } else if (storedStyle === 'dark') {
        styleSwitcherIcon.classList.add('ti-moon');
        new bootstrap.Tooltip(styleSwitcherIcon, { title: 'Dark Mode' });
      } else {
        styleSwitcherIcon.classList.add('ti-device-desktop');
        new bootstrap.Tooltip(styleSwitcherIcon, { title: 'System Mode' });
      }
    }
  }

  // Update images based on style
  switchImage(storedStyle);

  function switchImage(style) {
    if (style === 'system') {
      style = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
    }
    const switchImagesList = [].slice.call(document.querySelectorAll('[data-app-' + style + '-img]'));
    switchImagesList.map(imageEl => {
      const img = imageEl.getAttribute('data-app-' + style + '-img');
      if (img) imageEl.src = assetsPath + 'img/' + img;
    });
  }
})();
