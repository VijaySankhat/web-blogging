<?php

namespace App\Client;


use GuzzleHttp\Client;

abstract class AbstractClient
{
    /**
     * @param string $baseUri
     * @return Client
     */
    public function getClient(): Client {

        return new Client();

    }

}