<?php
  /*! MetaMorph - v1.0.0 - 09-09-2014
  * http://themesidea.co.uk/
  * Copyright (c) 2014
  */
?>
<div class="<?php print $classes; ?>">
  <?php print render($title_prefix); ?>
  <?php if ($title): ?><h1 class="title" id="page-title"><?php print $title; ?></h1><?php endif; ?>
  <?php print render($title_suffix); ?>
</div>
