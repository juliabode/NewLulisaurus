<header>
  <div class="container">
    <a class="brand" href="<?= esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
    <nav class="nav-primary">
      <?php
      if (has_nav_menu('primary_navigation')) :
        wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);
      endif;
      ?>
    </nav>

    <?php
        $options      = get_option('plugin_options');
        $social_media = array('facebook', 'twitter', 'xing', 'linkedin', 'mail');
    ?>

        <div>
            <ul class="social-media-links">
                <?php foreach ($social_media as $i => $name) {
                          if (!empty( $options['lulisaurus_' . $name . '_link'] )) {
                              echo '<li><a href="' . $options['lulisaurus_'.$name.'_link'] . '" target="_blank" class="fa fa-' . $name . '"></a></li>';
                          }
                      }
                ?>
            </ul>
        </div>
  </div>
</header>
