<?php
/**
 * Подключаем общие миксины компонентов
 */

$dir = get_template_directory() . '/partials/components';

foreach (glob($dir.'/*/*.php') as $files)
{
    require $files;
}

