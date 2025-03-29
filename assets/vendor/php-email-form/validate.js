/**
* PHP Email Form Validation - v3.7
* URL: https://bootstrapmade.com/php-email-form/
* Author: BootstrapMade.com
*/
(function () {
  "use strict";

  let forms = document.querySelectorAll('.php-email-form');

  forms.forEach(function(e) {
    e.addEventListener('submit', function(event) {
      event.preventDefault();

      let thisForm = this;
      let action = thisForm.getAttribute('action');
      let recaptcha = thisForm.getAttribute('data-recaptcha-site-key');

      // Mostrar mensaje de confirmación
      if (!confirm('¿Estás seguro de que deseas registrarte?')) {
        return; // Salir si el usuario cancela
      }

      // Mostrar estado de carga y ocultar mensajes de error o éxito
      let loadingElement = thisForm.querySelector('.loading');
      let errorMessageElement = thisForm.querySelector('.error-message');
      let sentMessageElement = thisForm.querySelector('.sent-message');

      if (loadingElement) loadingElement.classList.add('d-block');
      if (errorMessageElement) errorMessageElement.classList.remove('d-block');
      if (sentMessageElement) sentMessageElement.classList.remove('d-block');

      let formData = new FormData(thisForm);

      if (recaptcha) {
        if (typeof grecaptcha !== "undefined") {
          grecaptcha.ready(function() {
            try {
              grecaptcha.execute(recaptcha, { action: 'php_email_form_submit' })
                .then(token => {
                  formData.set('recaptcha-response', token);
                  php_email_form_submit(thisForm, action, formData);
                });
            } catch (error) {
              displayError(thisForm, error);
            }
          });
        } else {
          displayError(thisForm, 'The reCaptcha javascript API url is not loaded!');
        }
      } else {
        php_email_form_submit(thisForm, action, formData);
      }
    });
  });

  function php_email_form_submit(thisForm, action, formData) {
    fetch(action, {
      method: 'POST',
      body: formData,
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
      .then(response => {
        if (response.ok) {
          return response.text();
        } else {
          throw new Error(`${response.status} ${response.statusText} ${response.url}`);
        }
      })
      .then(data => {
        let loadingElement = thisForm.querySelector('.loading');
        let sentMessageElement = thisForm.querySelector('.sent-message');

        if (loadingElement) loadingElement.classList.remove('d-block');
        if (sentMessageElement) {
          if (data.trim() === 'OK') {
            sentMessageElement.classList.add('d-block');
            thisForm.reset(); // Reiniciar el formulario
            window.location.href = 'http://localhost/EcoReboot/inicio_sesion.php'; // Redirigir a la página de inicio de sesión
          } else {
            throw new Error(data ? data : 'Form submission failed and no error message returned from: ' + action);
          }
        }
      })
      .catch((error) => {
        displayError(thisForm, error);
      });
  }

  function displayError(thisForm, error) {
    let loadingElement = thisForm.querySelector('.loading');
    let errorMessageElement = thisForm.querySelector('.error-message');

    if (loadingElement) loadingElement.classList.remove('d-block');
    if (errorMessageElement) {
      errorMessageElement.innerHTML = error;
      errorMessageElement.classList.add('d-block');
    }
  }

})();

