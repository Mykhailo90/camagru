<link rel="stylesheet" href="../../public/styles/registration/registration.css">
<div class="content_center">
  <div class="all_form_conteiner">
    <form class="registr_form" action="/action_page.php">
      <div class="container">
        <div class="form_header">
          <h1>Авторизация</h1>
          <p>Пожалуйста, заполните поля, чтобы войти в приложение.</p>
          <hr>
        </div>

        <label for="email"><b>Электронный адрес</b></label>
        <input type="text" placeholder="Введите адрес @" name="email" required>

        <label for="psw"><b>Пароль</b></label>
        <input type="password" placeholder="Не менее 6 символов" name="psw" required>

        <a href="/registration"><p>Хочу войти, но нет аккаунта...</p></a>

        <div class="clearfix">
          <button type="button" class="cancelbtn">Упс... Забыл!(</button>
          <button type="submit" class="signupbtn">Регистрация</button>
        </div>
      </div>
    </form>
  </div>

</div>
