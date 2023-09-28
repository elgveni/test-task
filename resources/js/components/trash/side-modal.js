const sideModalButtons = document.querySelectorAll('.sidemodal--open');
const sideBackdrops = document.querySelectorAll('.sidemodal-backdrop');

sideModalButtons.forEach((sideModalButton) => {
  const modalId = sideModalButton.dataset.modalId;
  const sideModal = document.getElementById(modalId);
  const sideBackdrop = sideModal.nextElementSibling;
  const sideModalCloseButton = sideModal.querySelector('.sidemodal-close--button');

  sideModalButton.addEventListener('click', () => {
    sideModal.classList.toggle('active');
    sideBackdrop.classList.toggle('active');
    if (sideModal.classList.contains('active')) {
      window.location.hash = `sidebar-modal-${modalId}`;
    } else {
      window.location.hash = '';
    }
  });

  window.addEventListener('load', () => {
    if (window.location.hash === `#sidebar-modal-${modalId}`) {
      sideModal.classList.add('active');
      sideBackdrop.classList.add('active');
    }
  });

  // document.addEventListener('click', (event) => {
  //   if (!sideModal.contains(event.target) && !sideModalButton.contains(event.target)) {
  //     sideModal.classList.remove('active');
  //     sideBackdrop.classList.remove('active');
  //     history.replaceState(null, null, ' ')
  //   }
  // });

  sideModalCloseButton.addEventListener('click', () => {
    sideModal.classList.remove('active');
    sideBackdrop.classList.remove('active');
    history.replaceState(null, null, ' ')
  });

  document.addEventListener("keydown", (event) => {
    if (event.key === 'Escape') {
      sideModal.classList.remove('active');
      sideBackdrop.classList.remove('active');
      history.replaceState(null, null, ' ')
    }
  });
});
