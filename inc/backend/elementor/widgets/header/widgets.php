<?php

get_template_part( '/inc/backend/elementor/widgets/header/logo.php' );
get_template_part( '/inc/backend/elementor/widgets/header/menu.php' );
get_template_part( '/inc/backend/elementor/widgets/header/search.php' );
get_template_part( '/inc/backend/elementor/widgets/header/side-panel.php' );
get_template_part( '/inc/backend/elementor/widgets/header/menu-mobile.php' );
if ( class_exists( 'woocommerce' ) ) {
    get_template_part( '/inc/backend/elementor/widgets/header/cart.php' );
}