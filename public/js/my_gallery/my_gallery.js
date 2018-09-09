// Номер страницы для кнопок пагинации
var current_page = 1;
// Колчичество сохраненных изображений на странице
var per_page = 6;
// Переменная для хранения id выбранного эффекта
var id_eff = "empty";
// Переменная для хранения изображения с канваса для склейки
var img_main = "";

// Скрываем окно предварительного просмотра изображения
var preview = document.querySelector('#my_preview');
preview.style.display="none";
// Скрываем основной холст для отрисовки видео-контента
var main_canv = document.querySelector('#my_canvas');
main_canv.style.display="none";
//Определяем контексты для канвасов
ctx = main_canv.getContext('2d');
destCtx = preview.getContext('2d');
// Определяем кнопку для мгновенного снимка
var foto_btn = document.querySelector('#foto_btn');
// Определяем кнопку фото с таймингом
var timer_btn = document.querySelector('#timer_btn');           // Вставить определение поведения для кнопки сохранения информации
// Определяем кнопку сохранения информации
var save_btn = document.querySelector('#save_btn');

var on_load_btn = document.querySelector('.on_load');



// Определяем дефолтное поведение для кнопок
foto_btn.addEventListener("click", error_info);
timer_btn.addEventListener("click", error_info);
save_btn.addEventListener("click", save_error);
on_load_btn.addEventListener("click", change_window);


function change_window(){
  main_canv.style.display="none";
  preview.style.display="block";
}

function error_info(){
  alert("Необходимо подключение внешней камеры!");
}
// При загрузке страницы происходит выгрузка фотографий пользователя
window.onload = function() {
  ajaxPost('current_page=' + current_page + '&per_page=' + per_page);
};

function error_del (){
  alert("Для удаления, необходимо выбрать фото из раннее сохранненных!");
}

function save_error (){
  alert("Необходимо сделать снимок или загрузить фото!");
}

function make_foto(){
  setTimeout(make_prev, 5000);
  // Активируем кнопки сохранения информации
  save_btn.removeEventListener("click", save_error);
  save_btn.addEventListener("click", save_img);
}

function ajaxPost(data) {
    var request = new XMLHttpRequest();
    request.open('POST', '/my_gallery', true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(data);

    request.onreadystatechange = function () {
        if(request.readyState == 4 && request.status == 200) {
          var response = request.responseText;
  // Определяем точку выгрузки контента с фотографиями
          var side = document.querySelector('side');
  // Вставляем содержимое аякс ответа
          side.innerHTML = response;
  // Вешаем слушателя на кнопку удаления готовых фото пользователей
          del_btn = document.querySelector('#delete_btn');
          del_btn.addEventListener("click", error_del);
  //Вешаем слушателей на остальные кнопки
          foto_btn.addEventListener("click", error_info);
          timer_btn.addEventListener("click", error_info);

          var us_img = document.getElementsByClassName('users_card');
  // На каждую фотографию навешивается слушатель события нажатия для отображения в главном окне!
          for(var i = 0; i < us_img.length; i++) {
            us_img[i].addEventListener('click', function() {
              del_btn.removeEventListener("click", error_del);
              img_path = this.getAttribute('src');
              img_id = this.getAttribute('id');
              show_in_main_window(img_path, img_id);
            });
          }
    }
  }
}
// Открывается доступ для кнопки удаления старого фото
// Изображение открывается в главном окне, остальные окна скрываются
function show_in_main_window(img_path, img_id){
  var img = document.querySelector('#finish_foto');
  img.style.display="block";
  document.querySelector('#effect_img').style.display="none";
  document.querySelector('#my_canvas').style.display="none";
  preview.style.display="none";
  document.querySelector('#video').style.display="none";
  img.setAttribute("src", img_path);
  img.setAttribute("alt", img_id);
  // Корректируем поведение кнопок управления!
  foto_btn.addEventListener("click", error_info);
  timer_btn.addEventListener("click", error_info);
  save_btn.removeEventListener("click", save_img);
  save_btn.addEventListener("click", save_error);
  delete_img_from_db(img_id);
}
// Навешивается слушатель на кнопку удаления сохраненного фото из бд
// При нажатии происходит удаление и вывод сообщения о событии
function delete_img_from_db(img_id){
  del_btn.addEventListener("click", function(e){
  var request = new XMLHttpRequest();
  request.open('POST', '/my_gallery/del_img', true);
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  request.send('img_id=' + img_id);
  request.onreadystatechange = function () {
      if(request.readyState == 4 && request.status == 200) {
        var response = request.responseText;
        if (response == 'error'){
          alert("Вы не можете удалить чужую фотографию!")
        }
        else {
          alert("Фотография успешно удалена!")
          location.reload();
        }
      }
    }
  });
}


// Функция отправки данных с полей изображения и эффектов на сервер
// для отображения предварительной версии
function make_prev(){
  var ef_img = document.querySelector('#effect_img');

  if (ef_img.style.display!="none"){
    id_eff = ef_img.getAttribute('alt');
  }
  if (main_canv.style.display != "none"){
    // Обращаемся ко второму элементу канвас, создаем контекст

    // Рисуем изображение с главного холста
    destCtx.clearRect(0, 0, 640, 480);
    destCtx.drawImage(main_canv, 0, 0);
  // Отображаем наше превью и скрываем остальные источники изображений
    preview.style.display="block";
    document.querySelector('#effect_img').style.display="block";
    main_canv.style.display="none";
    document.querySelector('#finish_foto').style.display="none";
// Активируем кнопки сохранения информации
    save_btn.removeEventListener("click", save_error);
    save_btn.addEventListener("click", save_img);
  }
}

var video_btn = document.querySelector('.on_video');
//Видео будет транслироваться в канвас, как и загружаемое изображение!
// Склейка всегда будет принимать значение из канваса в пнг и наложку или пустоту!
video_btn.addEventListener("click", function (e) {
//Изменяем поведение кнопки мгновенного снимка!
foto_btn.removeEventListener("click", error_info);
timer_btn.removeEventListener("click", error_info);

foto_btn.addEventListener("click", make_prev);
timer_btn.addEventListener("click", make_foto);

save_btn.removeEventListener("click", save_img);
save_btn.addEventListener("click", save_error);

    document.querySelector('#effect_img').style.display="none";
    document.querySelector('#my_canvas').style.display="block";
    // document.querySelector('#for_loading').style.display="none";
    document.querySelector('#my_preview').style.display="none";
    document.querySelector('#finish_foto').style.display="none";
  // }

  var video = document.getElementById('video');
  // var canvas = document.querySelector('#my_canvas');

  ctx.clearRect(0, 0, 640, 480);

  localMediaStream = null;
  onCameraFail = function (e) {
            console.log('Камера на вашем устройстве технически неисправна!', e);
  };

  navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia;
        window.URL = window.URL || window.webkitURL;
        navigator.getUserMedia({video: true}, function(stream) {
          try {
              video.srcObject = stream;
              } catch (error) {
                  video.src = window.URL.createObjectURL(stream);
              }

            localMediaStream = stream;
        }, onCameraFail);

        cameraInterval = setInterval(function(){ snapshot();}, 1);

});


function snapshot(){
  if(localMediaStream){
    ctx.drawImage(video, 0, 0, 640, 480);
  }
}



//Навешиваем слушателя события нажатия на каждое изображение эффекта
var ef_img = document.getElementsByClassName('effects_img');
for(var i = 0; i < ef_img.length; i++) {
  ef_img[i].addEventListener('click', function() {
    var ef_path = this.getAttribute('src');
    ef_id = this.getAttribute('id');
    show_ef_in_window(ef_path, ef_id);
  });
}

// Отображаем эффект поверх основного изображения

function show_ef_in_window(img_path, img_id){
  // del_btn.removeEventListener("click", show_msg);
                                                      //Временное отключение функции удаления слушателя!
  // save_btn.removeEventListener("click", show_msg);
  var img = document.querySelector('#effect_img');
  // Проверить наличие атрибута, сравнить его содержимое
  if (img.hasAttribute('alt') && (img.getAttribute('alt') == img_id))
  {
    if (img.style.display!="none"){
      img.style.display="none";
    }
    else {
      img.style.display="block";
    }

  } else {
    img.style.display="block";
    img.setAttribute("src", img_path);
    img.setAttribute("alt", img_id);
  }
}

// Блок функций для работы с кнопками пагинации
//----------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
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
//----------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

// Функция для загрузки изображения в поле канваса
function previewFile() {
  // Активируем кнопку сохранения информации
  save_btn.removeEventListener("click", save_error);
  save_btn.addEventListener("click", save_img);

  foto_btn.removeEventListener("click", make_prev);
  timer_btn.removeEventListener("click", make_foto);

  foto_btn.addEventListener("click", error_info);
  timer_btn.addEventListener("click", error_info);
  // Cкрываем лишние экраны

  main_canv.style.display="none";
  preview.style.display="block";
  document.querySelector('#finish_foto').style.display="none";
  document.querySelector('#effect_img').style.display="none";

  var file    = document.querySelector('input[type=file]').files[0];
  var reader  = new FileReader();
  preview.style.display="block";
  reader.onloadend = function () {
    var imageLoader_img = new Image();
    imageLoader_img.onload = function () {
           preview.width = 640;
           preview.height = 480;
           destCtx.clearRect(0, 0, 640, 480);
           destCtx.drawImage(imageLoader_img, 0, 0, 640, 480);
       }
       imageLoader_img.src = event.target.result;
   }

  if (file) {
    reader.readAsDataURL(file);
  } else {
    preview.src = "";
  }
}

function save_on_server(data){
  var request = new XMLHttpRequest();
  request.open('POST', '/my_gallery/lips', true);
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  request.send(data);

  request.onreadystatechange = function () {
      if(request.readyState == 4 && request.status == 200) {
        var response = request.responseText;
        if (response != ""){
          console.log(response);
          alert("Произошла ошибка при попытке сохранить фотографию!")
        }
        location.reload();
      }
  }
}

function save_img(){
  if (document.querySelector('#effect_img').style.display!="none"){
    id_eff = document.querySelector('#effect_img').getAttribute('alt');
  }
  if(!id_eff){
    id_eff = "empty";
  }
  var save_user_img = new Image();
  save_user_img.src = preview.toDataURL("image/png");
  save_on_server('user_img=' + save_user_img.src + '&id_effect=' + id_eff);
}
