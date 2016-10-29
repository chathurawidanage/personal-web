<?php

require_once 'goutte.phar';

use Goutte\Client;

class PageFetch {

    public static function get($url) {
        $proxy = "cache.mrt.ac.lk:3128";
        $client = new Client();
        $client->getClient()->setDefaultOption('config/curl/' . CURLOPT_TIMEOUT, 0);
        $client->getClient()->setDefaultOption('config/curl/' . CURLOPT_FOLLOWLOCATION, true);
        //$client->getClient()->setDefaultOption('config/curl/' . CURLOPT_PROXY, $proxy);
        $page = $client->request('GET', $url);
        return $page;
    }

}
