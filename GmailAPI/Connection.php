<?php

namespace GmailAPI;

abstract class Connection
{
    /**
     * @var \Google_Service_Gmail $service
     */
    protected $service;

    public function __construct()
    {
        $this->service = $this->connect();
    }

    private function connect(): \Google_Service_Gmail
    {
        $client = new \Google_Client();
        $client->setApplicationName('Gmail Semec API');
        $client->setScopes(\Google_Service_Gmail::MAIL_GOOGLE_COM);
        $client->setAuthConfig(__DIR__ . '/storage/credentials.json');
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');

        $tokenPath = __DIR__ . '/storage/token.json';
        $accessToken = json_decode(file_get_contents($tokenPath), true);
        $client->setAccessToken($accessToken);

        if ($client->isAccessTokenExpired()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        }
        file_put_contents($tokenPath, json_encode($client->getAccessToken()));

        $service = new \Google_Service_Gmail($client);

        return $service;
    }
}
