
document.getElementById("dataform").addEventListener( 'submit', (e) => {

    e.preventDefault();

    const userName = document.getElementById('uname').value.trim();
    const emailId = document.getElementById('mail').value.trim();
    const mobileNumber = document.getElementById('mobile').value.trim();
    const dateOfBirth = document.getElementById('dob').value.trim();
    const age = document.getElementById('age').value.trim();
    const gender = document.querySelector('input[name="gender"]:checked');

    function isAlphabetic(value) {
        for (let i = 0; i < value.length; i++) {
            const charCode = value.charCodeAt(i);
            if (!((charCode >= 65 && charCode <= 90) || (charCode >= 97 && charCode <= 122))) {
                return false;
            }
        }
        return value.length > 0;
    }

    function isValidEmail(email) {
        if (!email.includes("@")) return false;
        const parts = email.split("@");

        if( ! parts[1].includes(".") ) return false;
        const subparts = parts[1].split(".")

        return parts[0].length > 0 && subparts[0].length > 1 && subparts[1].length > 1 ;
    }

    function isValidMobileNumber(number) {
        if (number.length !== 10) return false;
        for (let i = 0; i < number.length; i++) {
            const charCode = number.charCodeAt(i);
            if (!(charCode >= 48 && charCode <= 57)) {
                return false;
            }
        }
        return true;
    }

    function isValidDate(dateString) {
        const dateParts = dateString.split("-");
        if (dateParts.length !== 3) return false;
        const year = parseInt(dateParts[0], 10);
        const month = parseInt(dateParts[1], 10);
        const day = parseInt(dateParts[2], 10);
        if (isNaN(year) || isNaN(month) || isNaN(day)) return false;
        if (month < 1 || month > 12) return false;
        if (day < 1 || day > 31) return false;
        return true;
    }

    function isValidAge(ageValue) {
        const ageNumber = parseInt(ageValue, 10);
        return !isNaN(ageNumber) && ageNumber > 0;
    }

    if (!isAlphabetic(userName)) {
        alert("User Name must contain only alphabetic characters and cannot be empty.");
        return false;
    }

    if (!isValidEmail(emailId)) {
        alert("Please enter a valid Email Id.");
        return false;
    }

    if (!isValidMobileNumber(mobileNumber)) {
        alert("Mobile Number must be exactly 10 digits and contain only numeric characters.");
        return false;
    }

    if (!isValidDate(dateOfBirth)) {
        alert("Please enter a valid Date of Birth in the format YYYY-MM-DD.");
        return false;
    }

    if (!isValidAge(age)) {
        alert("Age must be a positive number greater than 0.");
        return false;
    }

    if( !gender ) {
        window.alert("Choose a Gender");
        return false;
    }

    alert("Form submitted successfully!");

    document.getElementById("dataform").reset();
    return true;
});


