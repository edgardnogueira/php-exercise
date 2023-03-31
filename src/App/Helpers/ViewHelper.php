<?php

namespace App\Helpers;

/**
 * Class ViewHelper
 *
 * Very simple helper class for rendering views.
 */
class ViewHelper
{
    /**
     * Render a view file.
     *
     * @param  string  $file
     * @param  array  $data
     *
     * @throws \Exception
     */
    public static function render(string $file, array $data = [])
    {
        extract($data);

        $viewsPath = __DIR__.'/../../../resources/views/';

        // check file exists
        if (! file_exists($viewsPath.$file.'.php')) {
            throw new \Exception('View file not found');
        }

        include $viewsPath.$file.'.php';
    }

    public static function escape(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
}
