<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;


class SiteMapController extends Controller
{

    public function createSitemap(){
        $domain = 'https://timnhacungban.com/';
        $filePath = '/var/www/html/phongtro/public/sitemap.xml';

        SitemapGenerator::create($domain)
            ->getSitemap()
            ->add(Url::create($domain)
                ->setLastModificationDate(Carbon::yesterday())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
                ->setPriority(0.1))
            ->writeToFile($filePath);
    }

}
