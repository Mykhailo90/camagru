<link rel="stylesheet" href="../../public/styles/registration/registration.css">
<div class="content_center">
  <div class="all_form_conteiner">
    <form class="registr_form">
      <div class="container">
        <div class="form_header">
          <h1>Восстановление пароля</h1>
          <p id="form_header_text">Внимательно заполните поля, чтобы получить доступ к приложению.</p>
          <hr>
        </div>
        <div class="fields">
          <label for="email"><b>Электронный адрес</b></label>
          <input id="email" type="text" placeholder="Введите адрес @" name="email" required>

          <label for="psw"><b>Новый Пароль</b></label>
          <input id="psw" type="password" placeholder="Не менее 6 символов" name="psw" required>

          <label for="psw-repeat"><b>Повторите пароль</b></label>
          <input id="psw-repeat" type="password" placeholder="Внимательно!" name="psw-repeat" required>

          <div class="clearfix">
            <a href="/autorization"><button type="button" class="cancelbtn">Не надо... Вспомнил!!!)</button></a>
            <button type="button" class="signupbtn">Отправить запрос!</button>
          </div>
        </div>

      </div>
    </form>
  </div>

</div>
