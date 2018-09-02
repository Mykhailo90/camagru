

function ajaxPost(data) {
    var request = new XMLHttpRequest();
    request.open('POST', '/', true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(data);

    request.onreadystatechange = function () {
        if(request.readyState == 4 && request.status == 200) {
          var response = request.responseText;
          var list = document.querySelector('.main_container');
          list.innerHTML = response;
        }
    }
  }

window.onload = function() {
  var current_page = 1;
  var per_page = (document.documentElement.clientWidth < 500) ? 6 : 12;
  ajaxPost('current_page=' + current_page + '&per_page=' + per_page);

  // var pages = document.querySelectorAll('.pagination a');
  //
  // pages.forEach(function (element) {
  //     element.addEventListener("click", function (e) {
  //       e.preventDefault();
  //     var url = element.getAttribute('href');
  //     page_number = element.dataset['page'];
  //     request = new XMLHttpRequest();
  //     request.open('POST', url, true);
  //     request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  //     request.send('page=' + page_number);
  //     request.onreadystatechange = function () {
  //       if (request.readyState == 4 && request.status === 200) {
  //         var ald_value = document.querySelector('#current');
  //         ald_value.removeAttribute('id');
  //         element.setAttribute('id', 'current');
  //         var list = document.querySelector('.list');
  //         list.innerHTML = request.responseText;
  //       }
  //     }
  //   });
  // });
};
