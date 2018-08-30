<link rel="stylesheet" href="../../public/styles/registration/registration.css">
<div class="content_center">
  <div class="all_form_conteiner">
    <form class="registr_form">
      <div class="container">
        <div class="form_header">
          <h1>Регистрация</h1>
          <p>Пожалуйста, заполните регистрационную форму.</p>
          <hr>
        </div>

        <label for="user"><b>Логин</b></label>
        <input id="login" type="text" placeholder="Введите логин" name="login" required>

        <label for="email"><b>Электронный адрес</b></label>
        <input id="email" type="text" placeholder="Введите адрес @" name="email" required>

        <label for="psw"><b>Пароль</b></label>
        <input id="psw" type="password" placeholder="Не менее 6 символов" name="psw" required>

        <label for="psw-repeat"><b>Повторите пароль</b></label>
        <input id="psw-repeat" type="password" placeholder="Внимательно!" name="psw-repeat" required>
        <p>Создавая аккаунт, вы подтверждаете согласие на хранение и использование размещенного контента.</p>
        <div class="clearfix">
          <a href="/"><button type="button" class="cancelbtn">Да ну НАХ...</button></a>
          <button type="button" class="signupbtn">Регистрация</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script src="../../public/js/registration/registration.js"></script>
