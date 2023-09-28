// Sample list of items for each instance
const itemsList = [
  ['1', '2', '3'],
  ['1', '2', '3'],
  ['1', '2', '3'],
  ['1', '2', '3'],
  ['1', '2', '3'],
  ['1', '2', '3'],
  ['1', '2', '3'],
  ['1', '2', '3'],
  ['1', '2', '3'],
  ['1', '2', '3'],
  ['1', '2', '3'],
  ['1', '2', '3'],
  ['1', '2', '3'],
  ['1', '2', '3']
];

// Function to update the suggestion list based on user input
function updateSuggestionList(dropdown) {
  const inputSuggestion = dropdown.querySelector('.input-suggestion');
  const suggestionList = dropdown.querySelector('.suggestion-list');
  const items = itemsList[Array.from(dropdowns).indexOf(dropdown)];

  const inputValue = inputSuggestion.value.toLowerCase();
  const filteredItems = items.filter(item => item.toLowerCase().startsWith(inputValue));

  suggestionList.innerHTML = '';

filteredItems.reverse().forEach(item => {
  const li = document.createElement('li');

  // Create a span element to wrap the item text
  const itemSpan = document.createElement('span');
  itemSpan.textContent = item;
  li.appendChild(itemSpan);

  // Set tabindex to make the list elements focusable
  li.tabIndex = 0;

  li.addEventListener('click', () => selectItem(li.textContent, inputSuggestion, suggestionList));
  li.addEventListener('keydown', event => {
    if (event.key === 'Enter' || event.key === ' ') {
      event.preventDefault();
      selectItem(li.textContent, inputSuggestion, suggestionList);
    }
  });

  li.addEventListener('click', event => {
    // Prevent the click event from propagating to the document click event listener
    event.stopPropagation();
    selectItem(li.textContent, inputSuggestion, suggestionList);
  });

  // Add a remove button to each suggestion
  const removeButton = document.createElement('button');
  removeButton.textContent = '×';
  removeButton.className = 'remove-button';

  // Add a click event listener to the remove button to prevent the event from bubbling up
  removeButton.addEventListener('click', event => {
    event.stopPropagation();
    removeItem(event, li, items, inputSuggestion, suggestionList);
  });

  li.appendChild(removeButton);
  suggestionList.appendChild(li);
});
}


// Function to handle item selection from the suggestion list
function selectItem(selectedItemText, inputSuggestion, suggestionList) {
  const valueWithoutSymbol = selectedItemText.replace(/×/g, '').trim();
  inputSuggestion.value = valueWithoutSymbol;
  suggestionList.innerHTML = '';
}

// Function to handle adding an item to the list
function handleAddItem(event) {
  const dropdown = event.target.closest('.suggestions');
  const inputSuggestion = dropdown.querySelector('.input-suggestion');
  const suggestionList = dropdown.querySelector('.suggestion-list');
  const items = itemsList[Array.from(dropdowns).indexOf(dropdown)];

  const newItem = inputSuggestion.value.trim();
  if (newItem) {
    items.push(newItem);
    updateSuggestionList(dropdown);
    inputSuggestion.value = '';
  }
}

// Function to handle removing a suggestion from the list
function removeItem(event, listItem, items, inputSuggestion, suggestionList) {
  event.stopPropagation();
  const suggestion = listItem.firstChild.textContent.trim();
  const itemIndex = items.indexOf(suggestion);
  if (itemIndex !== -1) {
    items.splice(itemIndex, 1);
    updateSuggestionList(listItem.closest('.suggestions'));
  }
}

// Function to close the suggestion list when clicking outside of it
function closeSuggestionList(event) {
  dropdowns.forEach(dropdown => {
    const suggestionList = dropdown.querySelector('.suggestion-list');
    if (!dropdown.contains(event.target)) {
      suggestionList.innerHTML = '';
    }
  });
}

// Query all dropdowns on the page
const dropdowns = document.querySelectorAll('.suggestions');

// Event listeners for each instance
dropdowns.forEach(dropdown => {
  const inputSuggestion = dropdown.querySelector('.input-suggestion');
  const suggestionList = dropdown.querySelector('.suggestion-list');
  const addItemButton = dropdown.querySelector('.add-item-button');

  inputSuggestion.addEventListener('input', () => updateSuggestionList(dropdown));
  inputSuggestion.addEventListener('focus', () => updateSuggestionList(dropdown));
  inputSuggestion.addEventListener('click', () => updateSuggestionList(dropdown));
  addItemButton.addEventListener('click', handleAddItem);
});

// Global click event listener to close the suggestion list when clicking outside of it
document.addEventListener('click', closeSuggestionList);
