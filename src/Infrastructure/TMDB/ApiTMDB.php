<?php

namespace App\Infrastructure\TMDB;

use function PHPUnit\Framework\throwException;

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
        curl_setopt($ch, CURLOPT_URL, $this->server.$path.'?'.$httpParams);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYSTATUS, false);
//        curl_setopt($ch, CURLOPT_VERBOSE, true);
//        var_dump(curl_getinfo($ch));
        try {
            $response = curl_exec($ch);
            try {
                $response = json_decode($response, true, 512, JSON_THROW_ON_ERROR);
            } catch (\Exception $e) {
                throwException('Error al conectar a TMDB');
            }

//            var_dump($response);
//            var_dump(curl_error($ch));
//            var_dump(curl_errno($ch));

            return $response;
        } catch (\Exception $e) {
            return false;
        }
    }
}
