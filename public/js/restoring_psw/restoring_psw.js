
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

function check_psw(err){
  var psw = document.querySelector('#psw');
  var real_psw = psw.value.trim();
  if (psw.value.length > 5 && psw.value.length <= 256)
  {
    var regexp = /(?=^.{6,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/gmi;
    if (email.value.search(regexp) >= 0){
      psw.classList.remove('error_input');
      return(1);
    }
    else {
      err.value = err.value +
        "Пароль введен некорректно!\n";
    }
  } else{
    err.value = err.value +
      "Пароль должен составлять от 6 до 256 непробельных символов!\n";
  }
  psw.classList.add('error_input');
  return(0);
};

function check_psw_repeat(err){
  var psw = document.querySelector('#psw').value;
  var psw_repeat = document.querySelector('#psw-repeat');
  if (psw == psw_repeat.value){
    psw_repeat.classList.remove('error_input');
    return(1);
  }
  else {
    psw_repeat.classList.add('error_input');
    err.value = err.value +
      "Введенные пароли не соответствуют!\n";
  }
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
    request.open('POST', '/restoring_psw', true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(data);

    request.onreadystatechange = function () {
        if(request.readyState == 4 && request.status == 200) {
          // var response = JSON.parse(request.responseText);
          var response = request.responseText;
          show_msg(response);
        }
    }
  }

window.onload = function() {
  var send_btn = document.querySelector('.signupbtn');
  send_btn.addEventListener('click', function(e){
    var psw = document.querySelector('#psw');
    if (psw != null){
      var res = 0;
      var err = {value: msg};
      err.value = '';
      res += check_email(err);
      res += check_psw(err);
      res += check_psw_repeat(err);
      if (res != 3){
        var msg = err.value;
        alert(msg);
      }
      else {
        var e = document.querySelector('#email').value;
        var p = document.querySelector('#psw').value;

        ajaxPost('login=' + v + '&email=' + e + '&psw=' + p);
      }
    }
    else{
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
        ajaxPost('email=' + e);
      }
    }
  });
};
