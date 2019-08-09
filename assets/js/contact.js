function validateForm() {
    var name =  document.getElementById('name').value;
    var email =  document.getElementById('email').value;
    var phone =  document.getElementById('phone').value;
    var subject =  document.getElementById('subject').value;
    var message =  document.getElementById('message').value;
    var status = document.getElementById('status');

    if (name == "") {
        status.className = 'alert alert-danger'
        status.innerHTML = "Name cannot be empty";
        return false;
    }else if (phone == "") {
        status.className = 'alert alert-danger'
        status.innerHTML = "Phone cannot be empty";
        return false;
    }else if (email == "") {
        status.className = 'alert alert-danger'
        status.innerHTML = "Email cannot be empty";
        return false;
    }else{
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if(!re.test(email)){
            status.className = 'alert alert-danger'
            status.innerHTML = "Email format invalid";
            return false;
        }
    }
    if(subject == "") {
        status.className = 'alert alert-danger'
        status.innerHTML = "Subject cannot be empty";
        return false;
    }else if (message == "") {
        status.className = 'alert alert-danger'
        status.innerHTML = "Message cannot be empty";
        return false;
    }else{
        status.classList.remove('alert-danger');
        status.className = 'alert alert-info'
        status.innerHTML = "Sending...";
        submit();
    }

}

function submit(){
    document.getElementById('status').innerHTML = "Sending...";
    formData = {
        'name'     : $('input[name=name]').val(),
        'email'    : $('input[name=email]').val(),
        'phone'  : $('input[name=phone]').val(),
        'subject'  : $('input[name=subject]').val(),
        'message'  : $('textarea[name=message]').val()
    };

    $.ajax({
        url: 'mail.php',
        type: 'POST',
        data: formData,
    })
    .done(function(data) {
        $('#status').text(data.message);
        if(data.code){
            $('#contact-form').closest('form').find("input[type=text], textarea").val("");
        }
    })
    .fail(function(err) {
       $('#status').text(err);
       console.log(err);
    })
    .always(function() {
        //console.log("complete");
    });

}
