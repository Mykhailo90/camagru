  var show_like = document.querySelector('.like_btn');
  show_like.addEventListener('click', function(e){
    alert("Показать лайки через аякс!");
  });

  var show_comments = document.querySelector('.comment_btn');
  show_comments.addEventListener('click', function(e){
    alert("Показать коменты через аякс!");
  });

  var make_like = document.querySelector('#like_gif');
  make_like.addEventListener('click', function(e){
    alert("Обновить значение лайков через аякс!");
  });

  var add_comment = document.querySelector('#com_gif');
  add_comment.addEventListener('click', function(e){
    document.querySelector('#form_for_comment').classList.toggle('unvisible');
  });
