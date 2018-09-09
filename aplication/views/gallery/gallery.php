<link rel="stylesheet" type="text/css" href="../../../public/styles/gallery/gallery.css">
<div class="foto">
  <table class="comment">
    <tr class="line">
      <td class="img_block"><div class="like_btn"><a><img id="lbtn" src="../../public/img/like1.png" alt="likes"></a></div></td>
      <td class="img_block"><div class="comment_btn"><a><img id="cbtn" src="../../public/img/comments.png" alt="comment"></a></div></td>
    </tr>
    <tr class="line">
      <td class="img_block"><span id="like_count"><?php echo $count_likes ?></span></td>
      <td class="img_block"><span id="comment_count"><?php echo $count_comments ?></span></td>
    </tr>
    <tr>
      <td colspan="2"><img id="main_img" data="<?php echo $img_id ?>" src="<?php echo $img_path ?>" alt="main_foto"></td>
    </tr>
    <tr class="line">
      <td class="img_block"><div class="like_btn"> <img id="like_gif" src="../../public/img/like_enter.gif" alt="L_OK"> </div></td>
      <td style="vertical-align: middle" class="img_block"><div class="comment_btn"><img id="com_gif" src="../../public/img/comment_1.gif" alt="Comment"></div></td>
    </tr>
  </table>
</div>

<div id="form_for_comment"  class="info_block, unvisible">
  <h2>Форма отправки комментария</h2>
    <div class="comment_form">
      <div class="text_in_form"><textarea id="comment_field" name="comment"></textarea></div>
      <div class="send_comment">
        <strong>Отправить</strong>
      </div>
  </div>
</div>

<div id="inf_field" class="info_block, unvisible">

</div>

<script src="../../public/js/gallery/gallery.js"></script>
