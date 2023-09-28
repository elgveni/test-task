/* INTL TEL INPUT */
const inputs = document.querySelectorAll("input[type=tel]");
inputs.forEach((input) => {
  input.addEventListener('input', formatPhoneNumber);
  input.addEventListener('change', formatPhoneNumber);
  input.addEventListener('keyup', formatPhoneNumber);
});

function formatPhoneNumber(event) {
  const rawValue = event.target.value.replace(/[^0-9]/g, '');

  // Add "-" after first 3 digits and then after second 3 digits
  const formattedValue = rawValue.replace(/^(\d{3})(\d{3})/, '$1-$2-');

  event.target.value = formattedValue;
}

const phoneInputs = Array.from(inputs).map((input) => {
  return window.intlTelInput(input, {
    initialCountry: "auto",
    geoIpLookup: (callback) => {
      fetch("https://ipapi.co/json")
        .then((res) => { return res.json(); })
        .then((data) => { callback(data.country_code); })
        .catch(() => { callback("il"); });
    },
    separateDialCode: true,
    allowDropdown: true,
    formatOnDisplay: true, // utilsScript
    utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/utils.js",
    preferredCountries: ["il", "ua", "ru", "us", "ca", "gb", "au", "fr", "de", "gr", "kz"],
    excludeCountries: ["cf", "cd", "af", "pm", "ba"]
  })
})