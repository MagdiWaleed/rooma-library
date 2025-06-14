
function validateWhatsNumber() {
    var whatsappNumber = document.forms["RegisterForm"]["whatsapp_number"].value;
    var error_whatsapp_number = document.getElementById("error-whatsapp_number");
    var isCheck = document.getElementById("isCheck");
    const formattedNumber = '2' + whatsappNumber;
    if (!validatePhone(whatsappNumber)) {
        error_whatsapp_number.innerHTML = "Invalid Phone Number";
    } 
    else
    {
        const data = JSON.stringify({
        number: formattedNumber
        });

        const xhr = new XMLHttpRequest();
        // xhr.withCredentials = true;

        xhr.addEventListener('readystatechange', function () {
            if (this.readyState === this.DONE) {
            const response = JSON.parse(this.responseText);
            console.log(response);
            if (response.status && response.valid) {
                error_whatsapp_number.innerHTML = "Verified ✅";
                error_whatsapp_number.style.color = "green";
                isCheck.innerHTML = "1";
            } else {
                error_whatsapp_number.innerHTML = "Not Valid ❌";
                isCheck.innerHTML = "0";//0
                console.log("Whatsapp Number is not valid from API");
            }
        }
        });

        xhr.open('POST', 'https://whatsapp-number-validators.p.rapidapi.com/v1/validate/wa_id');
        xhr.setRequestHeader('x-rapidapi-key', '9e03b009dcmsh2361b20e7438681p1885b4jsn6150b4c48389');
        xhr.setRequestHeader('x-rapidapi-host', 'whatsapp-number-validators.p.rapidapi.com');
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.setRequestHeader('Accept', 'application/json');
        xhr.send(data);
    }

}