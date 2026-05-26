<?php

namespace App\Helpers;

use HTMLPurifier;
use HTMLPurifier_Config;

class Purifier
{
    /**
     * Bersihkan HTML dari konten berbahaya (XSS).
     * Digunakan untuk output konten artikel dari CKEditor.
     */
    public static function clean(string $html): string
    {
        $config = HTMLPurifier_Config::createDefault();

        // Tag HTML yang diizinkan
        $config->set('HTML.Allowed',
            'p,br,strong,em,u,s,ul,ol,li,h2,h3,h4,blockquote,' .
            'a[href|target|rel],img[src|alt|width|height|style],' .
            'table,thead,tbody,tr,td[colspan|rowspan],th[colspan|rowspan],' .
            'figure,figcaption,pre,code,span[style]'
        );

        $config->set('URI.AllowedSchemes', ['http' => true, 'https' => true]);

        $config->set('HTML.TargetBlank', true);
        $config->set('HTML.TargetNoreferrer', true);
        $config->set('HTML.TargetNoopener', true);

        $config->set('HTML.SafeObject', false);
        $config->set('HTML.SafeEmbed', false);
        $config->set('Output.FlashCompat', false);

        $config->set('URI.Base', config('app.url'));
        $config->set('URI.MakeAbsolute', false);

        $cachePath = storage_path('framework/cache/htmlpurifier');
        if (! is_dir($cachePath)) {
            mkdir($cachePath, 0755, true);
        }
        $config->set('Cache.SerializerPath', $cachePath);

        $purifier = new HTMLPurifier($config);

        return $purifier->purify($html);
    }
}
