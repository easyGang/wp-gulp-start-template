<?php
/**
 * Created by PhpStorm.
 * User: sitemade.pro
 * Date: 19.11.2018
 */


if ( ! function_exists( 'section_main' ) ) {
    function section_main($title)
    {
        ?>
        <section class="section-main">
            <h3><?= $title ?></h3>
            <span>Как дела?</span>
        </section>
        <?php
    }

}else {
    print_r('Function name already exists! Change it!');
}
