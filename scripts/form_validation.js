function validateStreetAddress(address) {
  const addressPattern = /^[a-zA-Z0-9\s,.'-]{5,150}$/;
  return addressPattern.test(address);
}

// Full Name Validation
function validateFullName(fullName) {
  const namePattern = /^[A-Za-z\s]+$/; // Allows letters and spaces only
  return namePattern.test(fullName) && fullName.length >= 2 && fullName.length <= 100;
}

// Email Validation
function validateEmail(email) {
  const emailPattern = /^[a-zA-Z0-9]+([._-]?[a-zA-Z0-9]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z]{2,})+$/;
  const maxLength = 254;
  return email.length <= maxLength && emailPattern.test(email);
}

// Password Validation
function validatePassword(password, elements) {
  const { letter, capital, number, length, special } = elements;

  const lowerCaseLetters = /[a-z]/;
  const upperCaseLetters = /[A-Z]/;
  const numbers = /[0-9]/;
  const specialChars = /[!@#$%^&*(),.?":{}|<>]/;
  const minLength = 8;

  // Validate and update classes
  letter.classList.toggle("valid", lowerCaseLetters.test(password));
  letter.classList.toggle("invalid", !lowerCaseLetters.test(password));

  capital.classList.toggle("valid", upperCaseLetters.test(password));
  capital.classList.toggle("invalid", !upperCaseLetters.test(password));

  number.classList.toggle("valid", numbers.test(password));
  number.classList.toggle("invalid", !numbers.test(password));

  length.classList.toggle("valid", password.length >= minLength);
  length.classList.toggle("invalid", password.length < minLength);

  special.classList.toggle("valid", specialChars.test(password));
  special.classList.toggle("invalid", !specialChars.test(password));

  // Return overall validity
  return (
    lowerCaseLetters.test(password) &&
    upperCaseLetters.test(password) &&
    numbers.test(password) &&
    password.length >= minLength &&
    specialChars.test(password)
  );
}

// Show/Hide message box
function toggleMessageBox(messageBox, isVisible) {
  messageBox.style.display = isVisible ? "block" : "none";
}

// Create a span element with message and append to parent
function createErrorMessage(message, parentElement) {
  const errorMessage = document.createElement("span");
  errorMessage.classList.add("text-danger", "mt-2");
  errorMessage.style.display = "none";
  errorMessage.style.fontSize = "0.9em";
  errorMessage.innerHTML = message;
  parentElement.appendChild(errorMessage);
  return errorMessage;
}

// Handle password input elements and validation
function handlePasswordValidation() {
  const passwordInput = document.getElementById("password");
  const messageBox = document.getElementById("password-error");

  if (passwordInput && messageBox) {
    const letter = document.createElement("p");
    const capital = document.createElement("p");
    const number = document.createElement("p");
    const special = document.createElement("p");
    const length = document.createElement("p");

    // Add requirement messages dynamically
    letter.innerHTML = "A <b>lowercase</b> letter";
    capital.innerHTML = "A <b>capital</b> letter";
    number.innerHTML = "A <b>number</b>";
    special.innerHTML = "A <b>special character</b>";
    length.innerHTML = "Minimum <b>8 characters</b>";

    [letter, capital, number, special, length].forEach((el) => {
      el.classList.add("invalid");
      messageBox.appendChild(el);
    });

    // Show and hide the message box on focus/blur
    passwordInput.addEventListener("focus", () => toggleMessageBox(messageBox, true));
    passwordInput.addEventListener("blur", () => toggleMessageBox(messageBox, false));

    // Validate password on input
    passwordInput.addEventListener("input", () => {
      const passwordValid = validatePassword(passwordInput.value, { letter, capital, number, special, length });
      messageBox.classList.toggle("text-success", passwordValid);
      messageBox.classList.toggle("text-danger", !passwordValid);
    });
  }
}

// Handle email validation
function handleEmailValidation() {
  const emailInput = document.getElementById("email");
  const emailError = createErrorMessage("Invalid email address format.", emailInput.parentElement);

  emailInput.addEventListener("input", () => {
    emailError.style.display = validateEmail(emailInput.value) ? "none" : "block";
  });
}

// Handle full name validation
function handleFullNameValidation() {
  const fullNameInput = document.getElementById("fullName");
  if (fullNameInput) {
    const fullNameError = createErrorMessage(
      "Full name must contain only letters and spaces, with the length from 2 to 100 characters.",
      fullNameInput.parentElement
    );

    fullNameInput.addEventListener("input", () => {
      fullNameError.style.display = validateFullName(fullNameInput.value) ? "none" : "block";
    });
  }
}

function handleStreetAddressValidation() {
  const addressInput = document.getElementById("address");
  if (addressInput) {
    const addressError = createErrorMessage(
      "Street address must be between 5-150 characters and can include letters, numbers, spaces, and common symbols (,.'-).",
      addressInput.parentElement
    );

    // Validate on input
    addressInput.addEventListener("input", () => {
      addressError.style.display = validateStreetAddress(addressInput.value) ? "none" : "block";
    });
  }
}

// Attach validation to form submission
function handleFormSubmission() {
  const form = document.querySelector("form");
  const emailInput = document.getElementById("email");
  const passwordInput = document.getElementById("password");
  const messageBox = document.getElementById("password-error");

  form.addEventListener("submit", (event) => {
    const emailValid = validateEmail(emailInput.value);
    const passwordValid = validatePassword(passwordInput.value, {
      letter: messageBox.querySelector(":nth-child(1)"),
      capital: messageBox.querySelector(":nth-child(2)"),
      number: messageBox.querySelector(":nth-child(3)"),
      special: messageBox.querySelector(":nth-child(4)"),
      length: messageBox.querySelector(":nth-child(5)"),
    });

    if (!emailValid || !passwordValid) {
      event.preventDefault();
      if (!emailValid) toggleMessageBox(emailInput.parentElement.lastChild, true);
      if (!passwordValid) toggleMessageBox(messageBox, true);
    }
  });
}

// Function to load location data and populate dropdowns
function loadLocationData() {
  fetch('../scripts/location.json')  // Adjust the path if necessary
    .then(response => response.json())
    .then(locationData => {
      // Get the select elements
      const provinceSelect = document.getElementById("province");
      const districtSelect = document.getElementById("district");
      const communeSelect = document.getElementById("commune");

      if (provinceSelect && districtSelect && communeSelect) {
        // Function to populate dropdown options
        function populateDropdown(selectElement, data, key, value) {
          selectElement.innerHTML = '';  // Clear existing options

          // Add the "Select" option as disabled
          const selectOption = document.createElement("option");
          selectOption.value = "";
          selectOption.textContent = "Select";
          selectOption.disabled = true;
          selectOption.selected = true;  // Make it selected by default
          selectElement.appendChild(selectOption);

          // Add the rest of the options
          data.forEach(item => {
            const option = document.createElement("option");
            option.value = item[key];
            option.textContent = item[value];
            selectElement.appendChild(option);
          });
        }

        // Populate the Province dropdown
        populateDropdown(provinceSelect, locationData.province, "idProvince", "name");

        // Event listener for Province selection
        provinceSelect.addEventListener("change", function () {
          const selectedProvince = provinceSelect.value;

          // Filter the districts by selected province
          const filteredDistricts = locationData.district.filter(district => district.idProvince === selectedProvince);

          // Populate the District dropdown
          populateDropdown(districtSelect, filteredDistricts, "idDistrict", "name");

          // Enable the District dropdown and reset Commune dropdown
          districtSelect.disabled = filteredDistricts.length === 0;
          communeSelect.disabled = true;
          communeSelect.innerHTML = '';  // Clear the Commune options
          const defaultCommuneOption = document.createElement("option");
          defaultCommuneOption.value = "";
          defaultCommuneOption.textContent = "Select a commune";
          defaultCommuneOption.disabled = true;
          defaultCommuneOption.selected = true;
          communeSelect.appendChild(defaultCommuneOption);
        });

        // Event listener for District selection
        districtSelect.addEventListener("change", function () {
          const selectedDistrict = districtSelect.value;

          // Filter the communes by selected district
          const filteredCommunes = locationData.commune.filter(commune => commune.idDistrict === selectedDistrict);

          // Populate the Commune dropdown
          populateDropdown(communeSelect, filteredCommunes, "idCommune", "name");

          // Enable the Commune dropdown if there are any filtered communes
          communeSelect.disabled = filteredCommunes.length === 0;
        });
      }
    })
    .catch(error => {
      console.error('Error loading location data:', error);
    });
}

document.addEventListener("DOMContentLoaded", () => {
  handleFullNameValidation();
  handleEmailValidation();
  handlePasswordValidation();
  loadLocationData();
  handleStreetAddressValidation();
  handleFormSubmission();
});
