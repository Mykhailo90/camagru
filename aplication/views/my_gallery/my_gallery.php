<!-- Должна содержать от 3х до 6 элементов в ширину, возможно несколько рядов по высоте -->
<link rel="stylesheet" href="../../public/styles/my_gallery/my_gallery.css">

<div class="effects">
  <?php
    foreach ($effects as $value) {
      echo '<div class="effect_card">';
      echo '<img class="effects_img" id="'. $value['id'] .'" src="'. $value['path'] .'">';
      echo "</div>";
    }
  ?>
</div>
<div class="modul">
  <div class="main_button_panel">
    <div class="on_video"><span>Включить камеру</span></div>
    <div class="on_load">
      <!-- <form enctype="multipart/form-data" method="post"> -->
      <label>
        <input type="file" name="photo" multiple accept="image/*,image/jpeg">
        <span>Загрузить фото</span>
      </label>
    </div>
  </div>
  <div class="img_container">
    <video id="video"></video>
    <div class="for_finish_foto"></div>
    <div class="for_effects_row"></div>
    <div class="for_drowing"></div>
  </div>
  <div class="button_panel">
    <img class="panel" id="save_btn" src="../../public/img/save.png" alt="Сохранить">
    <img class="panel" id="timer_btn" src="../../public/img/timer.png" alt="Фото с задержкой">
    <img class="panel" id="foto_btn" src="../../public/img/foto.png" alt="Фото">
    <img class="panel" id="delete_btn" src="../../public/img/delete.png" alt="Удалить фото">
  </div>
</div>


<side></side>
<script type="text/javascript" src="public/js/my_gallery/my_gallery.js"></script>
