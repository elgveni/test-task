const toggleButtons = document.querySelectorAll('.profile-button');
const sidebar = document.querySelector('.side-holder');
const backdrop = document.querySelector('.side-backdrop');
const closeButton = document.querySelectorAll('.close-sidebar');
const sideHistory = document.querySelector('.side-history');
const toggleHistoryButton = document.querySelectorAll('.side-history--button');

function toggleSidebar() {
  sidebar.classList.toggle('active');
  backdrop.classList.toggle('active');
  if (sidebar.classList.contains('active')) {
    window.location.hash = 'sidebar';
  } else {
    window.location.hash = '';
  }
}

function toggleHistorySidebar() {
  sideHistory.classList.toggle('active');
}

toggleButtons.forEach(button => {
  button.addEventListener('click', () => {
    if (button.classList.contains('side-history--button')) {
      toggleHistorySidebar();
    } else {
      toggleSidebar();
    }
  });
});

// document.addEventListener('click', (event) => {
//   let buttonClicked = false;
//   toggleButtons.forEach(button => {
//     if (button.contains(event.target)) {
//       buttonClicked = true;
//     }
//   });

//   if (!sidebar.contains(event.target) && !buttonClicked) {
//     sidebar.classList.remove('active');
//     backdrop.classList.remove('active');
//     sideHistory.classList.remove('active');
//     window.location.hash = '';
//   }
// });

closeButton.forEach(button => {
  button.addEventListener('click', () => {
    sidebar.classList.remove('active');
    backdrop.classList.remove('active');
    sideHistory.classList.remove('active');
    window.location.hash = '';
  });
});

toggleHistoryButton.forEach(button => {
  button.addEventListener('click', toggleHistorySidebar);
});

window.addEventListener('load', () => {
  if (window.location.hash === 'sidebar') {
    toggleSidebar();
  }
});

document.addEventListener("keydown", (event) => {
  if (event.key === 'Escape') {
    sidebar.classList.remove('active');
    backdrop.classList.remove('active');
    sideHistory.classList.remove('active');
    window.location.hash = '';
  }
});



// avatar preview
const browseElements = document.querySelectorAll(".browse");

browseElements.forEach(browse => {
  const avatar = browse.closest(".avatar");
  const preview = avatar.querySelector(".avatar--preview");
  const emptyAvatar = avatar.querySelector(".avatar-empty");
  
  browse.addEventListener('change', (event) => {
    if (event.target.files.length > 0) {
      const src = URL.createObjectURL(event.target.files[0]);
      preview.src = src;
      preview.style.display = "block";
      emptyAvatar.style.display = "none";
    }
  });
});

function handleBrowseClick(spanElement) {
  const browseInput = spanElement.parentElement.querySelector(".browse");
  browseInput.click();
}
