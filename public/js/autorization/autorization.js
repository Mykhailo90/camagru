function check_email(err){
  var email = document.querySelector('#email');
  if (email.value.length <= 64)
  {
    var regexp = /^[-\w.]+@([A-z0-9][-A-z0-9]+\.)+[A-z]{2,4}$/gmi;
    if (email.value.search(regexp) >= 0){
      email.classList.remove('error_input');
      return(1);
    }
    else {
      err.value = err.value +
        "Электронный адрес введен некорректно!\n";
    }
  } else{
    err.value = err.value +
      "Электронный адрес не должен превышать 64 символов!\n";
  }
  email.classList.add('error_input');
  return(0);
};

function show_msg(msg){
  var header_text = document.querySelector('#form_header_text');
  header_text.classList.add('unvisible');

  var fields = document.querySelector('.fields');
  fields.remove();

  var my_msg = document.createElement('div');
  my_msg.className = "msg";
  my_msg.innerHTML = "<p>" + msg + "<p>";

  var parent = document.querySelector('.form_header');
  parent.appendChild(my_msg);
}

function ajaxPost(data) {
    var request = new XMLHttpRequest();
    request.open('POST', '/autorization', true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(data);

    request.onreadystatechange = function () {
        if(request.readyState == 4 && request.status == 200) {
          // var response = JSON.parse(request.responseText);
          var response = request.responseText;
          if (response == ''){
            location.reload();
          }
          show_msg(response);
        }
    }
  }

window.onload = function() {
  var send_btn = document.querySelector('.signupbtn');
  send_btn.addEventListener('click', function(e){
    var res = 0;
    var err = {value: msg};
    err.value = '';
    res += check_email(err);
    if (res != 1){
      var msg = err.value;
      alert(msg);
    }
    else {
      var e = document.querySelector('#email').value;
      var p = document.querySelector('#psw').value;
      ajaxPost('email=' + e + '&psw=' + p);
    }
  });
};
