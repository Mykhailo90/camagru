var current_page_c = 1;
var per_page_c = 1;
var img_id = document.querySelector('#main_img').getAttribute('data');
var current_page_l = 1;
var per_page_l = 3;

function next(){
  current_page_c += 1;
  ajaxPost_show_comment('current_page=' + current_page_c + '&per_page=' + per_page_c + '&img_id=' + img_id);
}

function prev(){
  current_page_c -= 1;
  ajaxPost_show_comment('current_page=' + current_page_c + '&per_page=' + per_page_c + '&img_id=' + img_id);
}

function start(){
  current_page_c = 1;
  ajaxPost_show_comment('current_page=' + current_page_c + '&per_page=' + per_page_c + '&img_id=' + img_id);
}

function finish(){
  var total = document.querySelector('.info_block').getAttribute('data');
  current_page_c = Math.ceil(total/per_page_c);
  ajaxPost_show_comment('current_page=' + current_page_c + '&per_page=' + per_page_c + '&img_id=' + img_id);
}

function ajaxPost_show_comment(data){
    var request = new XMLHttpRequest();
    request.open('POST', '/gallery/show_comments', true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(data);

    request.onreadystatechange = function () {
        if(request.readyState == 4 && request.status == 200) {
          var response = request.responseText;
          var info = document.querySelector('#inf_field');
          if(info.classList.contains('unvisible')){
            info.classList.remove('unvisible');
          }
          info.innerHTML = response;

        }
    }
  }

function ajaxPost_like(data){
    var request = new XMLHttpRequest();
    request.open('POST', '/gallery/add_like', true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(data);

    request.onreadystatechange = function () {
        if(request.readyState == 4 && request.status == 200) {
          var response = request.responseText;
          var likes = document.querySelector('#like_count');
          ald_likes = likes.textContent || likes.innerText;
          if (response == "ok"){
            new_value_likes = +ald_likes + 1;
            alert("Пользователь будет уведомлен о вашем мнении!!!");
          }
          else {
            new_value_likes = +ald_likes - 1;
            alert("Вы отменили свой лайк!((");
          }
          likes.innerHTML = new_value_likes;
        }
    }
  }

function ajaxPost_comment(data){
    var request = new XMLHttpRequest();
    request.open('POST', '/gallery/add_comment', true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(data);

    request.onreadystatechange = function () {
        if(request.readyState == 4 && request.status == 200) {
          var comments = document.querySelector('#comment_count');
          ald_comments = comments.textContent || comments.innerText;
          new_value_comments = +ald_comments + 1;
          comments.innerHTML = new_value_comments;
          alert("Комментарий успешно отправлен! Пользователь получит уведомление!");
        }
    }
  }

  function ajaxPost_show_likes(data){
      var request = new XMLHttpRequest();
      request.open('POST', '/gallery/show_likes', true);
      request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      request.send(data);

      request.onreadystatechange = function () {
          if(request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            var info = document.querySelector('#inf_field');
            if(info.classList.contains('unvisible')){
              info.classList.remove('unvisible');
            }
            info.innerHTML = response;
          }
      }
    }

  var show_like = document.querySelector('#lbtn');
  show_like.addEventListener('click', function(e){
    var inf = document.querySelector('#form_for_comment');
    if(!inf.classList.contains('unvisible')){
      inf.classList.add('unvisible');
    }

    ajaxPost_show_likes('img_id=' + img_id);
  });

  var show_comments = document.querySelector('#cbtn');
  show_comments.addEventListener('click', function(e){
  var inf = document.querySelector('#form_for_comment');
  if(!inf.classList.contains('unvisible')){
    inf.classList.add('unvisible');
  }

  ajaxPost_show_comment('current_page=' + current_page_c + '&per_page=' + per_page_c + '&img_id=' + img_id);



  });

  var make_like = document.querySelector('#like_gif');
  make_like.addEventListener('click', function(e){
    var img_id = document.querySelector('#main_img').getAttribute('data');
    ajaxPost_like('img_id=' + img_id);
  });

  var add_comment = document.querySelector('#com_gif');
  add_comment.addEventListener('click', function(e){
    document.querySelector('#form_for_comment').classList.toggle('unvisible');
    var info_block = document.querySelector('#inf_field');
    if(!info_block.classList.contains('unvisible')){
      info_block.classList.add('unvisible');
    }
  });

  var comment_btn = document.querySelector('.send_comment');
  comment_btn.addEventListener('click', function(e){
    var comment_text = document.querySelector('#comment_field').value.trim();
    if (comment_text.length < 1){
      alert("Вы не можете отправить пустой комментарий!");
    }
    else if (comment_text.length > 200){
      alert("Комментарий не может превышать 200 символов!");
    }
    else {
      var img_id = document.querySelector('#main_img').getAttribute('data');
      ajaxPost_comment('img_id=' + img_id + '&comment_text=' + comment_text);
      document.querySelector('#form_for_comment').classList.toggle('unvisible');
    }

  });
