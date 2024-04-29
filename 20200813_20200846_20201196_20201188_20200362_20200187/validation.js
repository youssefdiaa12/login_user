// Client-side validations
function submitForm(event) {

    // Prevent default form submission
    event.preventDefault();

    // Fetch form fields
    const formData = new FormData(document.getElementById('registrationForm'));

    // Perform validations
    let isValid = true;

    // Reset previous error messages
    resetErrorMessages();

    // Check if full name is filled
    if (!formData.get('fullName').trim()) {
        displayErrorMessage('fullNameError', 'Full Name is required');
        isValid = false;
    }

    // Check if username is filled
    if (!formData.get('userName').trim()) {
        displayErrorMessage('userNameError', 'User Name is required');
        isValid = false;
    }

    // Check if birthdate is filled
    if (!formData.get('birthdate').trim()) {
        displayErrorMessage('birthdateError', 'Birthdate is required');
        isValid = false;
    }
    // check that the birthdate not date in the future
    if (!validateBirthdate(formData)) {

        displayErrorMessage('birthdateError', 'Birthdate cannot be in the future');
        isValid = false;
    }

    // Validate email format
    if (!isValidEmail(formData.get('email'))) {
        displayErrorMessage('emailError', 'Invalid Email format');
        isValid = false;
    }

    // Validate phone number format
    if (!isValidPhoneNumber(formData.get('phone'))) {
        displayErrorMessage('phoneError', 'Invalid Phone number format');
        isValid = false;
    }

    // Check if address is filled
    if (!formData.get('address').trim()) {
        displayErrorMessage('addressError', 'Address is required');
        isValid = false;
    }

    // Validate password criteria
    if (!isValidPassword(formData.get('password'))) {
        displayErrorMessage('passwordError', 'Password must be at least 8 characters long and contain at least 1 number and 1 special character');
        isValid = false;
    }

    // Check if password matches confirm password
    if (formData.get('password') !== formData.get('confirmPassword')) {
        displayErrorMessage('confirmPasswordError', 'Passwords do not match');
        isValid = false;
    }
    // alert(formData.get('userImage').name);

    // check if the user image is selected
    if (!formData.get('userImage')) {
        displayErrorMessage('userImageError', 'Please select a user image');
        isValid = false;
    }
    if (is_validImage(formData.get('userImage').name) === false) {
        displayErrorMessage('userImageError', 'Please make sure that file extension is .jpg, .jpeg, .png or .gif');
        isValid = false;
    }

    // If all validations pass, submit the form via AJAX
    if (isValid) {
        // AJAX request
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'DB_Ops.php');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Handle successful response
                    const response = xhr.responseText;

                    console.log(response);
                    if (response === "File uploaded successfully") {
                        // Registration successful
                        alert("Registered Successfully");
                    } else {
                        // Registration failed
                        alert(response);
                    }
                } else {
                    // Handle error
                    console.error('Error:', xhr.statusText);
                }
            }
        };
        xhr.send(formData);
    }

// Function to display error messages
    function displayErrorMessage(elementId, message) {
        const errorElement = document.getElementById(elementId);
        if (errorElement) {
            errorElement.innerText = message;
        }
    }

// Function to reset error messages
    function resetErrorMessages() {
        const errorElements = document.querySelectorAll('.error');
        errorElements.forEach(element => {
            element.innerText = '';
        });
    }

// Function to validate birthdate
    function validateBirthdate(formData) {
        // Retrieve birthdate from form data
        const birthdate = new Date(formData.get('birthdate'));
        // Create a new Date object for the current date (without time part)
        const currentDate = new Date();
        currentDate.setHours(0, 0, 0, 0);

        // Check if the birthdate is in the future
        if (birthdate > currentDate) {
            // Display error message if birthdate is in the future
            displayErrorMessage('birthdateError', 'Birthdate cannot be in the future');
            return false;
        }
        return true;
    }

// Function to validate email format
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

// Function to validate phone number format
    function isValidPhoneNumber(phone) {

        const phoneRegex = /^\d{11}$/;
        return phoneRegex.test(phone);
    }

// Function to validate password criteria
    function isValidPassword(password) {
        const passwordRegex = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/;
        return passwordRegex.test(password);
    }

    function is_validImage(image) {
        const imageRegex = /\.(jpe?g|png|gif)$/i;
        ans = imageRegex.test(image);
        return ans;
    }

}