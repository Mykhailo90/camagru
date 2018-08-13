<?php foreach ($res as $val): ?>
<h3><?php echo $val['name'] ?></h3>
<?php endforeach; ?>

<div class="grid">
  <?php for($i = 0; $i < 9; $i++)
        if ($i == 5){
          echo '<div class="span-2">item-'.$i.'</div>';
          echo '<div class="span-2 subitems"><div>sub1</div><div>sub2</div></div>';}
        else {
            echo '<div>item-'.$i.'</div>';
        }

   ?>
</div>
