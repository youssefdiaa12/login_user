<?php include 'Header.php'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js" integrity="sha512-xij4o8KZ7Pn6zbD9JaD1Cw6rcE9zJ8UWv5MW6PB4T43hCM1Vjs5KvZtBCsXOlBtJSKrh2U1OheuAr8wFtq2pGA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="validation.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-iLd6+5YTH6IcNlSh7wntG3dHgkZVl4Z1jQ8Xo4OQvnqRKcb9+NDtEfB8j1OlnJcz16kibFJeqIThFbN1avH6zg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="styling.css">

<!-- Form -->
<form id="registrationForm" name="registrationForm" onsubmit="submitForm(event)"
    action="DB_Ops.php"
    method="POST"
      enctype = "multipart/form-data">
    <!-- Form fields go here -->
    <!-- Full Name -->
    <label for="fullName">Full Name:</label><br>
    <input type="text" id="fullName" name="fullName" required><br>
    <span id="fullNameError" class="error"></span><br>

    <!-- User Name -->
    <label for="userName">User Name:</label><br>
    <input type="text" id="userName" name="userName" required><br>
    <span id="userNameError" class="error"></span><br>

    <!-- Birthdate -->
    <label for="birthdate">Birthdate:</label><br>
    <input type="date" id="birthdate" name="birthdate" required><br>
    <button onclick="getActorsByBirthdate()">Get Actors Born on the Same Day</button><br>
    <span id="birthdateError" class="error"></span><br>

    <!-- Email -->
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br>
    <span id="emailError" class="error"></span><br>

    <!-- Phone -->
    <label for="phone">Phone:</label><br>
    <input type="tel" id="phone" name="phone" required><br>
    <span id="phoneError" class="error"></span><br>

    <!-- Address -->
    <label for="address">Address:</label><br>
    <input type="text" id="address" name="address" required><br>
    <span id="addressError" class="error"></span><br>
    <!-- Password -->
    <label for="password">Password:</label><br>
    <div style="position: relative;">
        <input type="password" id="password" name="password" required>
        <span id="togglePassword" class="password-toggle" onclick="togglePasswordVisibility()">
            <i class="fas fa-eye" id="eyeIcon" title="Toggle Password Visibility"></i>
        </span>
    </div>
    <span id="passwordError" class="error"></span><br>

    <!-- Confirm Password -->
    <label for="confirmPassword">Confirm Password:</label><br>
    <input type="password" id="confirmPassword" name="confirmPassword" required><br>
    <span id="confirmPasswordError" class="error"></span><br>

    <!-- User Image -->
    <label for="userImage">User Image:</label><br>
    <input type="file" id="userImage" name="userImage"><br>
    <span><img id="userImagePreview" src="#" alt="User Image"></span>
    <!-- Submit Button -->
    <input type="submit" value="Register">
</form>



<?php include 'Footer.php'; ?>
