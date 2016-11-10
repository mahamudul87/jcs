function validateEmail(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}

function formhash(event,form,password) {
    //prevent submit when submit button click
    event.preventDefault();
    //validation checking before process and submitting    
    if(form.login_email.value=="" && password.value==''){
    $("#login-status").html("<p class='error'>メールアドレスとパスワードを空にすることはできません！<br>Email and password cann't be empty!</p>");
    form.login_email.focus();
    return;
}
else if(form.login_email.value==""){
 $("#login-status").html("<p class='error'>メールは空にすることはできません！<br>Email cann't be empty!</p>");
 form.login_email.focus();
    return;
}

else if(password.value==''){
    $("#login-status").html("<p class='error'>パスワードは空にすることはできません！<br>Password cann't be empty!</p>");
    password.focus();
    return; 
}
else if(!validateEmail(form.login_email.value)){
$("#login-status").html("<p class='error'>無効なメールが入りました！<br>Invalid email entered!</p>");
form.login_email.focus();
    return; 
}
    // Create a new element input, this will be our hashed password field. 
    var p = document.createElement("input");

    // Add the new element to our form. 
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);

    // Make sure the plaintext password doesn't get sent. 
    password.value = "";

    // Finally submit the form. 
    form.submit();
}

function regformhash(form, uid, email, password, conf) {
    // Check each field has a value
    if (uid.value == '' || email.value == '' || password.value == '' || conf.value == '') {
        $("#register-status").html("<p class='error'>あなたは、要求されたすべての詳細を提供する必要があります！<br>You must provide all the requested details!</p>");
        return false;
    }
    
    // Check the username
    re = /^\w+$/; 
    if(!re.test(form.username.value)) { 
        $("#register-status").html("<p class='error'>Username must contain only letters, numbers and underscores!</p>"); 
        form.username.focus();
        return false; 
    }
    if(!validateEmail(email.value)) { 
        $("#register-status").html("<p class='error'>Invalid email, Please enter valid email!</p>"); 
        form.email.focus();
        return false; 
    }
    // Check that the password is sufficiently long (min 6 chars)
    // The check is duplicated below, but this is included to give more
    // specific guidance to the user
    if (password.value.length < 6) {
        $("#register-status").html("<p class='error'>Passwords must be at least 6 characters long!</p>");
        form.password.focus();
        return false;
    }
    
    // At least one number, one lowercase and one uppercase letter 
    // At least six characters 
    var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/; 
    if (!re.test(password.value)) {
        $("#register-status").html("<p class='error'>Passwords must contain at least one number, one lowercase and one uppercase letter!</p>");
        return false;
    }
    
    // Check password and confirmation are the same
    if (password.value != conf.value) {
        $("#register-status").html("<p class='error'>Your password and confirmation do not match. Please try again!</p>");
        form.password.focus();
        return false;
    }
        
    // Create a new element input, this will be our hashed password field. 
    var p = document.createElement("input");

    // Add the new element to our form. 
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);

    // Make sure the plaintext password doesn't get sent. 
    password.value = "";
    conf.value = "";

    // Finally submit the form. 
    form.submit();
    return true;
}
