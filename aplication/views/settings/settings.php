<link rel="stylesheet" href="../../public/styles/registration/registration.css">
<link rel="stylesheet" href="../../public/styles/settings/settings.css">
<h1><?php echo $_SESSION['login']; ?> - Мои настройки</h1>
<hr>
  <div class="settings_menu">
    <table>
      <tr id ="str_f">
        <td><div class="notification">
          <?php
            if ($notification == 1){
              echo $out_img;
            }
            else{
              echo $in_img;
            }
         ?>
       </div></td>
        <td><div class="del_page"> <img src="../../public/img/delete_profile.png" width="100px"> </div></td>
        <td><div class="change_settings"> <img src="../../public/img/base_settings.png" width="100px" > </div></td>
      </tr>
      <tr>
        <td><?php
          if ($notification == 1){
            echo $out_text;
          }
          else{
            echo $in_text;
          }
       ?></td>
        <td>Удалить аккаунт</td>
        <td>Изменить базовые настройки</td>
      </tr>
    </table>
  </div>
  <div id="form" class="unvisible">
    <div  class="content_center">
      <div class="all_form_conteiner">
        <form class="registr_form">
          <div class="container">
            <div class="form_header">
              <h1>Коррекция настроек</h1>
              <p id="form_header_text">Необходимо заполнить все поля формы.</p>
              <hr>
            </div>
            <div class="response"></div>
            <div class="fields">
              <label for="login"><b>Логин</b></label>
              <input id="login" type="text" placeholder="Введите Логин" name="login" required>


              <label for="email"><b>Электронный адрес</b></label>
              <input id="email" type="text" placeholder="Введите адрес @" name="email" required>

              <label for="psw"><b>Пароль</b></label>
              <input id="psw" type="password" placeholder="Не менее 6 символов" name="psw" required>

              <div class="clearfix">
                <button type="button" class="signupbtn">Изменить</button>
              </div>
            </div>

          </div>
        </form>
      </div>

    </div>
  </div>

  <script src="../../public/js/settings/settings.js"></script>
