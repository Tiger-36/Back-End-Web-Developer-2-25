const menuButton = document.querySelector('.menu-button');
const mainMenu = document.querySelector('.main-nav');

if (menuButton && mainMenu) {
  menuButton.addEventListener('click', () => {
    const isOpen = mainMenu.classList.toggle('open');
    menuButton.setAttribute('aria-expanded', String(isOpen));
  });
}

document.querySelectorAll('[data-current-year]').forEach((element) => {
  element.textContent = new Date().getFullYear();
});

const form = document.querySelector('.contact-form');

if (form) {
  form.addEventListener('submit', (event) => {
    event.preventDefault();
    let isValid = true;

    form.querySelectorAll('[required]').forEach((field) => {
      const error = field.closest('.field')?.querySelector('.error');
      field.classList.remove('invalid');
      if (error) error.textContent = '';

      if (!field.checkValidity()) {
        isValid = false;
        field.classList.add('invalid');
        if (error) error.textContent = field.type === 'email' ? 'Inserisci un indirizzo email valido.' : 'Questo campo è obbligatorio.';
      }
    });

    const status = form.querySelector('.form-status');
    status.textContent = isValid ? 'Grazie! Il messaggio è pronto per essere inviato.' : 'Controlla i campi evidenziati.';
  });
}
