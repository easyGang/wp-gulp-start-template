<?php
/**
 * Created by PhpStorm.
 * User: sitemade.pro
 * Date: 19.11.2018
 */
if (!function_exists('section-footer')) {
    function section_footer()
    {
        ?>
            <span>Footer</span>
        <?php
    }

} else {
    print_r('Function name already exists! Change it!');
}
