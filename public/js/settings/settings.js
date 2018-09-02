function check_login(err){
  var login = document.querySelector('#login');
  var real_login = login.value.trim();
  if (real_login.length > 0 && real_login.length <= 64)
  {
    var regexp = /^[а-яА-ЯёЁa-zA-Z0-9_+-.,@<> ()]+$/gmi;
    if (login.value.search(regexp) >= 0){
      login.classList.remove('error_input');
      return(1);
    }
    else {
      err.value = err.value +
        "В качестве Логин возможно использовать\nсимволы: [а-яА-ЯёЁa-zA-Z0-9_+-.,@<> ()]\n";
    }
  } else{
    err.value = err.value +
      "В поле Логин не могут быть только пробельные символы, длина должна быть не более 64 символов!\n";
  }
  login.classList.add('error_input');
  return(0);
};

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
    request.open('POST', '/settings', true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(data);

    request.onreadystatechange = function () {
        if(request.readyState == 4 && request.status == 200) {
          // var response = JSON.parse(request.responseText);
          location.reload();
        }
    }
  }

  function ajaxPost_for_del(data) {
      var request = new XMLHttpRequest();
      request.open('POST', '/settings', true);
      request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      request.send(data);

      request.onreadystatechange = function () {
          if(request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            document.querySelector('table').classList.add('unvisible');
            var info = document.querySelector('.settings_menu');
            info.innerHTML = response;
          }
      }
    }

    function ajaxPost_for_change_settings(data) {
        var request = new XMLHttpRequest();
        request.open('POST', '/settings', true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send(data);

        request.onreadystatechange = function () {
            if(request.readyState == 4 && request.status == 200) {
              var response = request.responseText;
              var info = document.querySelector('.response');
              info.innerHTML = response;
            }
        }
      }

window.onload = function() {
  var settings = document.querySelector('.change_settings');
  settings.addEventListener('click', function(e){

    var form = document.querySelector('#form');
    form.classList.remove("unvisible");


    var update = document.querySelector('.signupbtn');
    update.addEventListener('click', function(e){
      var res = 0;
      var err = {value: msg};
      err.value = '';
      res += check_login(err);
      res += check_email(err);
      res += check_psw(err);
      if (res != 3){
        var msg = err.value;
        alert(msg);
      }
      else {
        var v = document.querySelector('#login').value;
        var e = document.querySelector('#email').value;
        var p = document.querySelector('#psw').value;
        document.querySelector('.fields').classList.add('unvisible');
        document.querySelector('#form_header_text').classList.add('unvisible');
        ajaxPost_for_change_settings('login=' + v + '&email=' + e + '&psw=' + p);
      }
    });
  });

  var notification = document.querySelector('.check_img');
  notification.addEventListener('click', function(e){
  var value = document.querySelector('.check_img').getAttribute('id');
  ajaxPost('notification=' + value);
  });

  var del = document.querySelector('.del_page');
  del.addEventListener('click', function(e){
  ajaxPost_for_del('del_page=' + 'delete');
  });

};
