var current_page = 1;
var per_page = 4;

var video_btn = document.querySelector('.on_video');
video_btn.addEventListener("click", function (e) {
  var video = document.getElementById('video');
  if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
      navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
          video.srcObject = stream;
          video.play();
      });
  }
});
// function new_window(img_id){
//   var is_registr = document.querySelector('.is_reg').getAttribute('id');
//   if (is_registr != 'undef'){
//     var url = "gallery/show/" + img_id;
//     win = window.open(url, '_blank');
//     win.focus();
//   }else {
//     alert("Чтобы просматривать фото и оставлять комментарии необходимо авторизироваться!!!")
//   }
// }
//
// function search_count_content(){
//   if (document.documentElement.clientWidth < 500){
//     per_page = small_screen;
//   } else if (document.documentElement.clientWidth < 800) {
//     per_page = medium_screen;
//   } else {
//     per_page = full_screen;
//   }
// }
//
function next(){
  current_page += 1;
  ajaxPost('current_page=' + current_page + '&per_page=' + per_page);
}

function prev(){
  current_page -= 1;
  ajaxPost('current_page=' + current_page + '&per_page=' + per_page);
}

function start(){
  current_page = 1;
  ajaxPost('current_page=' + current_page + '&per_page=' + per_page);
}

function finish(){
  var total = document.querySelector('.img_list').getAttribute('data');
  current_page = Math.ceil(total/per_page);
  ajaxPost('current_page=' + current_page + '&per_page=' + per_page);
}

function ajaxPost(data) {
    var request = new XMLHttpRequest();
    request.open('POST', '/my_gallery', true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(data);

    request.onreadystatechange = function () {
        if(request.readyState == 4 && request.status == 200) {
          var response = request.responseText;
          var side = document.querySelector('side');
          side.innerHTML = response;
          var us_img = document.getElementsByClassName('users_card');
          for(var i = 0; i < us_img.length; i++) {
            us_img[i].addEventListener('click', function() {
              alert(this.getAttribute('src'));
              //Взять путь к фото этого объекта и вставить в рисунок второго объекта!
              //Сделать активной кнопку для удаления (желательно визуально это отобразить!)
            });
          }
    }
  }
}

window.onload = function() {
  ajaxPost('current_page=' + current_page + '&per_page=' + per_page);
};
