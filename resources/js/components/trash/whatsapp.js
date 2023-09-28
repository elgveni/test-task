const chatContact = document.querySelector('.chat-contacts-item');
const chatEmpty = document.querySelector('.chat-empty');
const chatRoom = document.querySelector('.chat-room');
const backButton = document.querySelector('.back-button');

window.addEventListener('DOMContentLoaded', () => {
  chatRoom.style.display = 'none';
  chatEmpty.style.display = 'grid';
});

chatContact.addEventListener('click', () => {
  chatRoom.style.display = 'block';
  chatEmpty.style.display = 'none';
});

backButton.addEventListener('click', () => {
  chatRoom.style.display = 'none';
  chatEmpty.style.display = 'grid';
});

const messageInput = document.querySelector('.chat-action-message textarea');
const chatActionMessage = document.querySelector('.chat-action-message textarea');
const sendMessageButton = document.querySelector('.chat-action-button button');

function handleInput() {
  const messageText = messageInput.value.trim();

  if (messageText === '') {
    sendMessageButton.classList.add('disabled');
    sendMessageButton.setAttribute('disabled', true);
  } else {
    sendMessageButton.classList.remove('disabled');
    sendMessageButton.removeAttribute('disabled');
  }

  const popOver = document.querySelector('.popover')
  const slashIndex = messageText.indexOf('/');
    if (slashIndex !== -1) {
      popOver.classList.add('popover-active');
    } else {
      popOver.classList.remove('popover-active');
  }
}

messageInput.addEventListener('input', handleInput);
window.addEventListener('DOMContentLoaded', handleInput);