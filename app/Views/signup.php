<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sign up form created as a task for intern selection process at Bodhami">
    <meta name="author" content="Chinmay Joshi">
    <title>Sign Up</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- external css -->
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/styles.css'); ?>"> -->
    <!-- external js -->
    <!-- <script src="<?php echo base_url('assets/js/script.js'); ?>"></script> -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: sans-serif;
            background-color: azure;
        }

        h1,
        label {
            background-color: transparent;
        }

        h1 {
            margin-top: 30px;
        }

        label {
            margin-left: 5px;
        }

        label>span {
            color: red;
            /* font-size: 9px; */
            background-color: transparent;
            margin-left: 3px;
        }

        .container {
            width: 375px;
            height: 95vh;
            border: 3px solid #eee;
            box-shadow: 0 0 15px 4px rgba(0, 0, 0, 0.06);
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
            align-items: center;
            margin: 20px auto;
            background-color: white;
        }

        .form-fields {
            display: flex;
            flex-direction: column;
            width: 100%;
            justify-content: space-between;
            align-items: flex-start;
            background-color: transparent;
            padding: 20px;
        }

        .form-control {
            display: flex;
            flex-direction: column;
            width: 100%;
            justify-content: space-evenly;
            align-items: flex-start;
            background-color: transparent;
        }

        .form-control label {

            display: block !important;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 5px 0 10px 0;
            outline: none;
            border: 0;
            border-bottom: 1px solid #eee;
            border-radius: 10px;
            box-shadow: 0 0 15px 4px rgba(0, 0, 0, 0.06);
            font-family: inherit;
            font-size: inherit;
            transition: .2s ease-in-out;
        }

        input:focus {
            font-size: smaller;
        }

        input[type=submit] {
            border: none;
            background-color: #3F51B5;
            color: #fff;
            font-weight: 600;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .warningText {
            color: red;
            font-size: 9px;
            background-color: transparent;
            margin-left: 5px;
            margin-bottom: 5px;
            height: 9px;
        }

        .warningTextBig {
            color: red;
            font-size: 9px;
            background-color: transparent;
            margin-left: 5px;
            margin-bottom: 15px;
            height: 18px;
        }
    </style>
</head>

<body onload="enableSubmit()">
    <form id="signup-form" method="post">
        <div class="container">
            <h1>Sign Up</h1>
            <div class="form-fields">
                <div class="form-control">
                    <label for="fname">First Name<span>*</span></label>
                    <input id="fname" type="text" placeholder="First Name" name="fname" required oninput="nameValidation(this.value,'fname')">
                    <span></span>
                </div>
                <div class="form-control">
                    <label for="lname">Last Name<span>*</span></label>
                    <input id="lname" type="text" placeholder="Last Name" name="lname" required oninput="nameValidation(this.value,'lname')">
                    <span></span>
                </div>
                <div class="form-control">
                    <label for="email">Email Address<span>*</span></label>
                    <input id="email" type="email" placeholder="Email" name="email" required oninput="emailValidation(this.value)">
                    <span></span>
                </div>
                <div class="form-control">
                    <label for="pnumber">Phone Number<span>*</span></label>
                    <input id="pnumber" type="tel" placeholder="Phone" name="pnumber" required oninput="phoneValidation(this.value)">
                    <span></span>
                </div>
                <div class="form-control">
                    <label for="password">Password<span>*</span></label>
                    <input id="password" type="password" placeholder="Password" name="password" required oninput="passwordValidation(this.value)">
                    <span></span>
                </div>
                <div class="form-control">
                    <label for="confirm-password">Confirm Password<span>*</span></label>
                    <input id="confirm-password" type="password" placeholder="Re-enter Password" name="confirm-password" required oninput="repeatPasswordValidation(this.value)">
                    <span></span>
                </div>
                <div class="form-control">
                    <button id="submit" type="submit" name="submit" disabled></button>
                </div>
            </div>
        </div>
    </form>
</body>
<script>
    function enableSubmit() {
        // // get error from the url
        // const urlParams = new URLSearchParams(window.location.search);
        // const error = urlParams.get('error');
        // if (error === 'user_exists') {
        //     // user already exists
        //     alert("User already exists. Please change your email.");
        //     // Retrieve the previously entered form data from local storage
        //     const fname = localStorage.getItem('fname');
        //     const lname = localStorage.getItem('lname');
        //     const pnumber = localStorage.getItem('pnumber');
        //     // clear the error parameter from url to make it look better
        //     const currentUrl = window.location.href;
        //     const updatedUrl = currentUrl.replace('?error=user_exists', '');
        //     window.history.replaceState({}, document.title, updatedUrl);
        //     // pre fill the form with previous data
        //     document.getElementById('fname').value = fname;
        //     validFields["fname"] = true;
        //     document.getElementById('lname').value = lname;
        //     validFields["lname"] = true;
        //     document.getElementById('pnumber').value = pnumber;
        //     validFields["pnumber"] = true;
        // }
        // disable submit button until all fields are valid
        var button = document.getElementById("submit");
        button.style.cursor = "not-allowed";
        button.style.opacity = "0.5"
        button.title = "Please enter valid data in all mandatory fields";
        // check if fields are valid
        if (Object.values(validFields).every(value => value === true)) {
            // all fields are valid so enable submit button
            button.disabled = false;
            button.style.cursor = "";
            button.style.opacity = "";
            button.title = "Submit";
            clearInterval(intervalId);
        } else {
            button.style.cursor = "not-allowed";
            button.style.opacity = "0.5"
            button.title = "Please enter valid data in all mandatory fields";
            var intervalId = setInterval(enableSubmit, 1000);
        }
    }
    // keep track of validated fields- total 6
    var validFields = {
        'fname': false,
        'lname': false,
        'pnumber': false,
        'email': false,
        'password': false,
        'confirm-password': false
    };

    // First Name - only alphabets
    // Last Name - only alphabets
    function nameValidation(str, id) {
        var inputField = document.querySelector('#' + id);
        var spanElement = document.querySelector('#' + id + ' + span');
        spanElement.classList.add("warningText");
        // empty field
        if (str == '' || /^[\s]+$/.test(str)) {
            inputField.style.borderColor = "red";
            spanElement.textContent = 'Field cannot be empty';
            validFields[id] = false;
            localStorage.removeItem(id);
        } else {
            // number or special characters
            if (/^[a-zA-Z\s]+$/.test(str)) {
                inputField.style.borderColor = "green";
                spanElement.textContent = '';
                validFields[id] = true;
                localStorage.setItem(id, str);
                spanElement.classList.remove("warningText");
            } else {
                inputField.style.borderColor = "red";
                spanElement.textContent = 'Field cannot contain numbers or special characters';
                validFields[id] = false;
                localStorage.removeItem(id);
            }
        }
    }
    // Email - email validation
    function emailValidation(str) {
        var inputField = document.querySelector("#email");
        var spanElement = document.querySelector('#email + span');
        spanElement.classList.add("warningText");
        // empty field
        if (str == '' || /^[\s]+$/.test(str)) {
            inputField.style.borderColor = "red";
            spanElement.textContent = 'Field cannot be empty';
            validFields["email"] = false;
            localStorage.removeItem('email');
        }
        if (/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(str)) {
            inputField.style.borderColor = "green";
            spanElement.textContent = '';
            validFields["email"] = true;
            localStorage.setItem('email', str);
            spanElement.classList.remove("warningText");
        } else {
            inputField.style.borderColor = "red";
            spanElement.textContent = 'Email not valid';
            validFields["email"] = false;
            localStorage.removeItem('email');
        }
    }
    // Phone number -
    // a. only + and numbers allowed.
    // b. If + is there, 13 digits are allowed. 13 digits is excluding + symbol.
    // c. Should not start with 0
    // d. if + is not there only 10 digits allowed
    function phoneValidation(str) {
        var inputField = document.querySelector("#pnumber");
        var spanElement = document.querySelector('#pnumber + span');
        spanElement.classList.add("warningText");
        // empty field
        if (str == '' || /^[\s]+$/.test(str)) {
            inputField.style.borderColor = "red";
            spanElement.textContent = 'Field cannot be empty';
            validFields["pnumber"] = false;
            localStorage.removeItem('pnumber');
        }
        if (/^(?!0)[+]?(\d{13}|\d{10})$/.test(str)) {
            inputField.style.borderColor = "green";
            spanElement.textContent = '';
            validFields["pnumber"] = true;
            localStorage.setItem('pnumber', str);
            spanElement.classList.remove("warningText");
        } else {
            inputField.style.borderColor = "red";
            spanElement.textContent = 'Phone number not valid';
            validFields["pnumber"] = false;
            localStorage.removeItem('pnumber');
        }
    }
    // Password
    // a. Min length - 6
    // b. Should contain at-least one alphabet, one number, one char among @#$&!
    function passwordValidation(str) {
        var inputField = document.querySelector("#password");
        var spanElement = document.querySelector('#password + span');
        spanElement.classList.add("warningTextBig");
        if (str == '' || /^[\s]+$/.test(str)) {
            inputField.style.borderColor = "red";
            spanElement.textContent = 'Field cannot be empty';
            validFields["password"] = false;
        }
        if (/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@#$&!]).{6,}$/.test(str)) {
            inputField.style.borderColor = "green";
            spanElement.textContent = '';
            validFields["password"] = true;
            spanElement.classList.remove("warningTextBig");
        } else {
            inputField.style.borderColor = "red";
            spanElement.textContent = 'Password must be 6 characters long and contain at least one alphabet,one number and one special character among @#$&!';
            validFields["password"] = false;
        }
        // if (!/[a-zA-Z]/.test(str)) {
        //     inputField.style.borderColor = "red";
        //     spanElement.textContent = "Password must contain at least one alphabet.";
        //     validFields["password"] = false;
        // }

        // if (!/\d/.test(str)) {
        //     inputField.style.borderColor = "red";
        //     spanElement.textContent = "Password must contain at least one number.";
        //     validFields["password"] = false;
        // }
        // if (!/[@#$&!]/.test(str)) {
        //     inputField.style.borderColor = "red";
        //     spanElement.textContent = "Password must contain at least one special character among @#$&!";
        //     validFields["password"] = false;
        // }
        // if(/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@#$&!]).{6,}$/.test(str)){
        // inputField.style.borderColor = "green";
        // spanElement.textContent = '';
        // validFields["password"] = true;
        // }
    }

    // Repeat Password
    // a. Should match with the Password field
    function repeatPasswordValidation(str) {
        var inputField = document.querySelector("#confirm-password");
        var spanElement = document.querySelector('#confirm-password + span');
        spanElement.classList.add("warningText");
        var password = document.querySelector("#password").value;
        if (str == '' || /^[\s]+$/.test(str)) {
            inputField.style.borderColor = "red";
            spanElement.textContent = 'Field cannot be empty';
            validFields["password"] = false;
        }
        if (str == password) {
            inputField.style.borderColor = "green";
            spanElement.textContent = '';
            validFields["confirm-password"] = true;
            spanElement.classList.remove("warningText");
        } else {
            inputField.style.borderColor = "red";
            spanElement.textContent = 'Password not matching';
            validFields["confirm-password"] = false;
        }
    }
</script>
<script>
    $(document).ready(function () {
        $("#signup-form").submit(function (e) {
            e.preventDefault();
console.log("381");
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('signup'); ?>",
                data: $(this).serialize(),
                dataType: "json",
                success: function (response) {
                    if (response.status == "success") {
                        // Redirect or show a success message
                        window.location.href = "<?php echo base_url('signup/success'); ?>";
                    } else if (response.status == "error") {
                        // Display error messages
                        $("#error-messages").html(response.message);
                    }
                }
            });
        });
    });
</script>


</html>