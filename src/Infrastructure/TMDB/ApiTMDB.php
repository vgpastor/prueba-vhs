<?php

namespace App\Infrastructure\TMDB;

class ApiTMDB
{
    private string $apiKey;

    private string $language;

    private string $server = 'https://api.themoviedb.org/3';

    public function __construct(string $apiKey, string $language = 'es-ES')
    {
        $this->apiKey = $apiKey;

        // @todo: verify if language it's allowed in TMDB
        $this->language = (!is_null($language)) ? $language : null;
    }

    public function call(string $method, string $path, array $params = null): array
    {
        $ch = curl_init();

        $httpParams = http_build_query([
            'api_key' => $this->apiKey,
            'language' => $this->language,
        ]);

        $headers = [
            'Content-Type: application/json',
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if (!is_null($params)) {
            switch ($method) {
                case 'POST':
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
                    break;
                case 'PUT':
                    curl_setopt($ch, CURLOPT_PUT, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
                    break;
                case 'GET':
                default:
                    $httpParams .= '&'.http_build_query($params);
                    break;
            }
        }
        curl_setopt($ch, CURLOPT_URL, $this->server.'/'.$path.'?'.$httpParams);

        try {
            $response = curl_exec($ch);
            var_dump($response);

            return json_decode($response);
        } catch (\Exception $e) {
            return false;
        }
    }
}
