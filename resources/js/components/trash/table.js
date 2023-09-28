// expand rows
const TableRow = document.querySelectorAll('.row')

TableRow.forEach(click => {
  click.addEventListener('click', (event) => {
  event.target.parentElement.classList.toggle('row-active')
  })
})


// search logic
let tableSearch = document.querySelectorAll('.table-search');

function submitSearch(event) {
  const searchBox = event.target.closest('.table-search');
  const searchInput = searchBox.querySelector('.search-input');
  const searchSubmitButton = searchBox.querySelector('.search-submit-button');
  const searchClearButton = searchBox.querySelector('.search-clear-button');
  
  let inputValue = searchInput.value;
  if (inputValue !== "") {
    searchSubmitButton.style.display = "none";
    searchClearButton.style.display = "inline-block";
  } else {
    searchSubmitButton.style.display = "inline-block";
    searchClearButton.style.display = "none";
  }
  // Perform search logic here
}

function clearSearch(event) {
  const searchBox = event.target.closest('.table-search');
  const searchInput = searchBox.querySelector('.search-input');
  const searchSubmitButton = searchBox.querySelector('.search-submit-button');
  const searchClearButton = searchBox.querySelector('.search-clear-button');
  
  searchInput.value = "";
  searchSubmitButton.style.display = "inline-block";
  searchClearButton.style.display = "none";
}

tableSearch.forEach(searchBox => {
  const searchSubmitButton = searchBox.querySelector('.search-submit-button');
  const searchClearButton = searchBox.querySelector('.search-clear-button');

  searchSubmitButton.addEventListener('click', submitSearch);
  searchClearButton.addEventListener('click', clearSearch);
});





