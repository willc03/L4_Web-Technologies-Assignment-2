/*
    Author: Will Corkill
    Name: formValidation.js
    Last Accessed: 18/02/2022
    Description: This will be used to make sure that the forms on the website are fully validated.
*/

window.onload = function() 
{

    // Login form
    if (document.getElementById("signup"))
    {
        // Get password element
        let password = document.getElementById("password");
        // Get different criteria elements
        let criteria = 
        {
            length: document.getElementById("length"),
            uppercase: document.getElementById("uppercase"),
            lowercase: document.getElementById("lowercase"),
            number: document.getElementById("number"),
            special: document.getElementById("special")
        }
        password.onkeyup = function() 
        {
            var currentPassword = password.value;
            // Validate the length of the password first
            if (currentPassword.length >= 8) 
            {
                criteria.length.classList.remove("invalid");
                criteria.length.classList.add("valid");
            }
            else
            {
                criteria.length.classList.remove("valid");
                criteria.length.classList.add("invalid");
            }
            // Validate an uppercase letter
            var uppercaseRegEx = /[A-Z]/g;
            if (currentPassword.match(uppercaseRegEx))
            {
                criteria.uppercase.classList.remove("invalid");
                criteria.uppercase.classList.add("valid");
            }
            else
            {
                criteria.uppercase.classList.remove("valid");
                criteria.uppercase.classList.add("invalid");
            }
            // Validate a lower case letter
            var lowercaseRegEx = /[a-z]/g;
            if (currentPassword.match(lowercaseRegEx))
            {
                criteria.lowercase.classList.remove("invalid");
                criteria.lowercase.classList.add("valid");
            }
            else
            {
                criteria.lowercase.classList.remove("valid");
                criteria.lowercase.classList.add("invalid");
            }
            // Validate a number
            var numberRegEx = /[0-9]/g;
            if (currentPassword.match(numberRegEx))
            {
                criteria.number.classList.remove("invalid");
                criteria.number.classList.add("valid");
            }
            else
            {
                criteria.number.classList.remove("valid");
                criteria.number.classList.add("invalid");
            }
            // Validate a special character
            var specialCharacterRegex = /[!@£$%^&*()+=,<.>/?:;"'|±§]/g;
            if (currentPassword.match(specialCharacterRegex))
            {
                criteria.special.classList.remove("invalid");
                criteria.special.classList.add("valid");
            }
            else
            {
                criteria.special.classList.remove("valid");
                criteria.special.classList.add("invalid");
            }
        };
    }

};