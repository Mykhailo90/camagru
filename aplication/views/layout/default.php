<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8">
  <!--Reset all styles to default-->
  <link rel="stylesheet" type="text/css" href="../../../public/styles/reset.css">
  <link rel="stylesheet" type="text/css" href="../../../public/styles/default/default.css">

  <link rel="stylesheet" type="text/css" href="../../../public/styles/main/main.css">
  <link rel="stylesheet" type="text/css" href="../../../public/styles/404_error/404_error.css">
  <title>Camagru</title>
</head>

<body>
  <header>
    <div class="header_container">
      <div class="header_top_menu">
        <div class="left_side">
          <a href="/gallery"><img title="Поиск" src="public/img/search-user.png" width="40" height="40"></a>
          <input class="header_input" type="text" placeholder="user_login" name="search" value="">
        </div>
        <div class="right_side">
          <a href="/registration"><img title="Регистрация" src="public/img/icon1.png" width="40" height="40"></a>
          <a href="/autorization"><img title="Авторизация" src="public/img/key.png" width="40" height="40"></a>
        </div>
      </div>

      <div class="logo_row content_center">
            <span id='logo'>Camagru</span>
    </div>
  </div>
  </header>
  <main class="main_container">
  <?php echo "$content"; ?>
  </main>
  <footer class="footer_all">
    <div class="content_center">
      <a href="https://www.facebook.com/profile.php?id=100001749961535">&copy; msarapii</a>
    </div>
  </footer>
</body>
</html>
