<?php
  /*! MetaMorph - v1.0.0 - 09-09-2014
  * http://themesidea.co.uk/
  * Copyright (c) 2014
  */
?>
<div class="<?php print $classes; ?>">
  <?php if (isset($logo)): ?>
    <div class="site-logo clearfix">
      <?php print $linked_logo; ?>
    </div>
  <?php endif; ?>
  <?php print $content; ?>
</div>
