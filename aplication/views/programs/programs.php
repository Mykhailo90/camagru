

<div class="delimeter">
  <div class="left"></div>
  <div class="right"></div>
</div>

<div class="programs_page">


  <section class="filtr">
    <div class="filtr_form">
      <form>
        <fieldset>
          <legend>Фильтр вывода</legend>
          <div class="tr">
            <div class="r">
              <label for="direction">Тип <em>*</em></label>
                <select>
                  <option selected disabled>Выберите Тип</option>
                  <?php foreach ($filterType as $value): ?>
                    <option value="<?php echo $value['id']; ?>"><?php echo $value['type_name']; ?></option>
                  <?php endforeach; ?>
                </select>
            </div>
            <div class="r">
              <label for="data">Для кого</label>
              <select>
                <option selected disabled>Выберите направление</option>
                <?php foreach ($filterForWhom as $value): ?>
                  <option value="<?php echo $value['id_direction'] ?>"><?php echo $value['title'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="r">
              <label for="direction">Тематика</label>
              <select>
                <option selected disabled>Сфера применения</option>
                <?php foreach ($filterSubjects as $val): ?>
                  <option value="<?php echo $val['id'] ?>"><?php echo $val['subject_name'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="r">
              <label for="data">Куратор</label>
              <select>
                <option selected disabled>Укажите тренера</option>
                <?php foreach ($filterTrainer as $val): ?>
                  <option value="<?php echo $val['id'] ?>"><?php echo $val['trener_name'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="r">
              <label for="direction">Дата</label>
              <select>
                <option selected disabled>Выберите время</option>
                <option value="На этой неделе">На этой неделе</option>
                <option value="В этом месяце">В этом месяце</option>
                <option value="Группа формируется">Группа формируется</option>
              </select>
            </div>
            <div class="r">
              <label for="data">Цена</label>
              <select>
                <option selected disabled>Фильт стоимости</option>
                <option value="До 500 грн">До 500 грн</option>
                <option value="501-1000 грн">501-1000 грн</option>
                <option value="1001-3500 грн">1001-3500 грн</option>
                <option value="3501-6500 грн">3501-6500 грн</option>
                <option value="6501-10000 грн">6501-10000 грн</option>
                <option value="10001-25000 грн">10001-25000 грн</option>
                <option value="25001-50000 грн">25001-50000 грн</option>
                <option value="50001+ грн">50001+ грн</option>
              </select>
            </div>



          </div>
        </fieldset>
        <p class="button">
          <input class="default-button, filt_button"  type="submit" value="Отправить">
        </p>
      </form>
    </div>

  </section>

  <section class="prog_list">
      <?php foreach ($programs as $value) {?>
        <div class='prog_cards'>
        <img class="prog_image" src="../../../public/img/corporate.jpg" alt="f1">
      <?php echo $value['title'];?>
      </div>
      <?php } ?>

      <div class="pagination">
        <?php
          for ($i=1; $i <= $pages ; $i++) { ?>
            <a <?php
              if ($_SESSION['current_page'] == $i )
              {
                echo "id = 'current'";
              }
             ?>data-page="<?php echo $i;?>" href="<?php echo $url?>"><?php echo $i;?></a>
        <?php } ?>
      </div>
  </section>
</div>
