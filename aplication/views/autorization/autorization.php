<link rel="stylesheet" href="../../public/styles/registration/registration.css">
<div class="content_center">
  <div class="all_form_conteiner">
    <form class="registr_form">
      <div class="container">
        <div class="form_header">
          <h1>Авторизация</h1>
          <p id="form_header_text">Пожалуйста, заполните поля, чтобы войти в приложение.</p>
          <hr>
        </div>
        <div class="fields">
          <label for="email"><b>Электронный адрес</b></label>
          <input id="email" type="text" placeholder="Введите адрес @" name="email" required>

          <label for="psw"><b>Пароль</b></label>
          <input id="psw" type="password" placeholder="Не менее 6 символов" name="psw" required>

          <a href="/registration"><p>Хочу войти, но нет аккаунта...</p></a>

          <div class="clearfix">
            <a href="/restoring_psw"><button type="button" class="cancelbtn">Упс... Забыл!(</button></a>
            <button type="button" class="signupbtn">Авторизация</button>
          </div>
        </div>

      </div>
    </form>
  </div>

</div>
<script src="../../public/js/autorization/autorization.js"></script>
