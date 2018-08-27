<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8">
  <!--Reset all styles to default-->
  <link rel="stylesheet" type="text/css" href="../../../public/styles/reset.css">
  <link rel="stylesheet" type="text/css" href="../../../public/styles/main/main.css">
  <title>Camagru</title>
</head>

<body>
  <header>
    <div class="header_container">
      <div class="header_top_menu">
        <a href="/gellery"><img src="public/img/user-search-icon.png" width="30" height="30"></a>
        <input type="text" placeholder="user_login" name="search" value="">
        <!-- <ul class="right-side">
          <li>
            <a href="#">
              <i class="fas fa-globe"></i> RU
              <i class="fas fa-angle-down"></i>
            </a>
          </li>
          <li>
            <a href="#">Вход</a>
          </li>
          <li>
            <a href="#">Регистрация</a>
          </li>
        </ul></div> -->
      <div class="logo_row">
        <div class="logo_conteiner">
          <span id='logo'>Camagru</span>
        </div>
        <div id="video-bg">
          <video height="100" preload="auto" volume = "0" autoplay="autoplay" loop="loop">
          <source src="public/img/fire_background_loop2_videvo2.mov" type="video/mp4"></source>
        </video>
      </div>

    </div>
    </div>
  </header>
  <?php echo "$content"; ?>
  <footer class="footer_all">
    <div class="logo_conteiner">
      <a href="https://www.facebook.com/profile.php?id=100001749961535">&copy; msarapii</a>
    </div>
  </footer>
</body>
</html>
