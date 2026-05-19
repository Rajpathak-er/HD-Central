<?php get_header(); ?>
<div class="container">
    <div class="row">
       <div class="h2"><? the_title();?></div>
       <div class="text-center">
             <nav><?php wp_nav_menu([
                    'container_class' => 'blog-menu',
                    'theme_location' => 'blog_menu'
                             ]); ?>
            </nav>
       </div>
        <div class="col-md-8 col-sm-12">
            <?php 
            $menu_name = 'blog_menu';
            $locations = get_nav_menu_locations();

            if( $locations && isset( $locations[ $menu_name ] ) ){
               //print_r( wp_get_nav_menu_items('3339'));
	// получаем элементы меню
	$menu_items = wp_get_nav_menu_items( $locations[ $menu_name ] );
  
	// создаем список
	$menu_list = '<ul id="menu-' . $menu_name . '">';

	foreach (  $menu_items as $key => $menu_item ){
		$menu_list .= '<li><a href="' . $menu_item->url . '">' . $menu_item->title . '</a></li>';
	}

	$menu_list .= '</ul>';
}
else {
	$menu_list = '<ul><li>Меню "' . $menu_name . '" не определено.</li></ul>';
}
            echo $menu_list; ?>
        </div>
        <div class="col-2">2</div>
    </div>
</div>
<?php get_footer();?>