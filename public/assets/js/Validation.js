function validateForm() {


    var email = document.forms["RegisterForm"]["email"].value;
    var password = document.forms["RegisterForm"]["password"].value;
    var phone = document.forms["RegisterForm"]["phone"].value;
    var whatsappNumber = document.forms["RegisterForm"]["whatsapp_number"].value;
    var confirmPassword = document.forms["RegisterForm"]["confirm_password"].value;
    var errorEmail = document.getElementById("error-email");
    var errorPassword = document.getElementById("error-password");
    var errorPhone = document.getElementById("error-phone");
    var error_whatsapp_number = document.getElementById("error-whatsapp_number");
    var error_confirm_password = document.getElementById("error-confirm_password");
    var isCheck = document.getElementById("isCheck").innerHTML;
    var isValid = true;
    if (!validateEmail(email)) {
        errorEmail.innerHTML = "Invalid Email";
        isValid = false;
    } 
    else
    {
        errorEmail.innerHTML = "";
    }

    if (!validatePassword(password)) {
        errorPassword.innerHTML = "Invalid Password";
        isValid = false;
    } 
    else
    {
        errorPassword.innerHTML = "";
    }
    
    if (!validatePhone(phone)) {
        errorPhone.innerHTML = "Invalid Phone Number";
        isValid = false;
    } 
    else
    {
        errorPhone.innerHTML = "";
    }
    
    if (isCheck === "" || whatsappNumber==="") {
        error_whatsapp_number.innerHTML = "Enter the Whatsapp Number and Check it";
        isValid = false;
    }
    else if (isCheck==="0")
    {
        isValid = false;
    }


    if (!validateConfirmPassword(password,confirmPassword)) {
        error_confirm_password.innerHTML = "Confirm password does not match the password";
        isValid = false;
    }
    else
    {
        error_confirm_password.innerHTML = "";
    }
    
    // if (isValid) {
    //     document.getElementById("RegisterForm").submit();
    // }
    isValid = true;
    return isValid
}

function validateEmail(email) {
    var re1 = /^[a-zA-Z0-9_.±]+@[a-zA-Z0-9-.]+(\.)[a-zA-Z0-9]+$/;
    return re1.test(String(email).toLowerCase());
}
function validatePassword(password) {
    var re = /^(?=.*\d)(?=.*[\W_]).{8,}$/;
    return re.test(String(password).toLowerCase());
}
function validatePhone(phone) {
    var re = /^01\d{9}$/;
    return re.test(String(phone).toLowerCase());
}
function validateConfirmPassword(password,confirmPassword) {
    if(password === confirmPassword)
        return true;
    else
        return false;
}
 
function register(event) {
   
    if (!validateForm()) return;
    
    var form = document.getElementById("RegisterForm");
    var formData = new FormData(form);
    
    var xhr = new XMLHttpRequest();
    xhr.open('POST', form.action, true);
    
    // REQUIRED: Set headers to identify as AJAX request
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Accept', 'application/json');
    
    xhr.onload = function() {
        console.log("Status:", xhr.status);
        console.log("Response:", xhr.responseText);
        
        try {
            var response = JSON.parse(xhr.responseText);
            
            if (xhr.status >= 200 && xhr.status < 300) {
                // Success case
                if (response.redirect) {
                    window.location.href = response.redirect;
                    alert(response.message || "Registration successful!");
                } 
            } else {
                // Error case
                if (response.errors) {
                    
                    console.log("Validation errors:", response.errors);
                    alert("Please fix the errors below.");
                    displayServerErrors(response.errors);
                } else {
                    alert(response.message || "An error occurred");
                }
            }
        } catch (e) {
            console.error("Failed to parse JSON:", e);
            alert("Unexpected response from server");
        }
    };
    
    xhr.onerror = function() {
        alert("Network error occurred");
    };
    
    xhr.send(formData);
}



function displayServerErrors(errors) {
    console.log("Processing errors:", errors); // Debug log
    
    // Clear all previous errors
    document.querySelectorAll('[id^="error-"]').forEach(el => {
        el.textContent = '';
        el.style.display = 'none';
    });
    
    // Highlight fields with errors
    for (const field in errors) {
        const errorElement = document.getElementById(`error-${field}`);
        const inputField = document.querySelector(`[name="${field}"]`);
        
        console.log(`Processing ${field}:`, { errorElement, inputField }); 
        
        if (errorElement) {
            
            errorElement.textContent = errors[field][0];
            errorElement.style.color = '#dc3545';
            errorElement.style.display = 'block';
        }
        
        if (inputField) {
            inputField.classList.add('is-invalid'); 
            inputField.focus();
        }
    }
}
  

  function whatsappNumber() {
    const whatsappNumber = document.getElementById("whatsapp_number").value;
    if (validatePhone(whatsappNumber)){
    console.log(whatsappNumber);
    const formData = new FormData();
    formData.append("whatsapp_number", whatsappNumber); 
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../../logic/API_Ops.php", true);
  
    xhr.onload = function () {
      if (xhr.status === 200) {
        
          const response = JSON.parse(xhr.responseText);
          alert("Message: " + response.message);
      } else {
        console.error("Error status:", xhr.status);
      }
    };
  
    xhr.onerror = function () {
      console.error("Network error occurred.");
    };
  
    xhr.send(formData);
    }else{}
}
  