const validate = (input, id) => {
    
    if (input == "") {
        clearTextbox(id);
        return;
    }
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let usernameValid = JSON.parse(this.responseText).validStatus;
            let responseMsg = JSON.parse(this.responseText).responseMsg;
            clearTextbox(id);
            switch (usernameValid) {
                case 1:
                    setValidTextbox(id);
                    break;
                case 0:
                    setInvalidTextbox(id, responseMsg);
                    break;
                case -1:
                    setInvalidTextbox(id, responseMsg);
                    break;
                default:
                    break;
            }
        }
    };

    if (input !== "") {                                                    
        xmlhttp.open("POST", BASE_URL + "/register/validate", true);
        xmlhttp.setRequestHeader('Content-Type', 'application/json');
        xmlhttp.send(JSON.stringify({
            "key": id,
            "value": input
        }));
        
    }   

}

const validatePassword = () => {
    const passwd = document.getElementById('password').value;
    const passConfirm = document.getElementById('password_confirmation').value;
    if (passwd === passConfirm)
    {
        setValidTextbox('password');
        setValidTextbox('password_confirmation');
    } else {
        setInvalidTextbox('password');
        setInvalidTextbox('password_confirmation', "Konfirmasi password tidak cocok dengan input password");
    }
}

const clearTextbox = (identifier) => {
    let input = document.getElementById(identifier);
    input.classList.remove('invalid-input', 'valid-input');
    input.nextElementSibling.innerHTML = "";
}


const setValidTextbox = (identifier) => {
    clearTextbox(identifier);
    document.getElementById(identifier).classList.remove('invalid-input');
    document.getElementById(identifier).classList.add('valid-input');
}


const setInvalidTextbox = (identifier, invalidMessage="") => {
    let input = document.getElementById(identifier);
    input.classList.remove('valid-input');
    input.classList.add('invalid-input');
    input.nextElementSibling.innerHTML = invalidMessage;
}



