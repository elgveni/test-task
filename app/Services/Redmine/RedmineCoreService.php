<?php
namespace App\Services\Redmine;


abstract class RedmineCoreService
{
    protected $path;
    protected $baseUrl;
    protected $apiKey;

    /**
     * RedmineCoreService constructor
     *
     * Initializes the base URL and API key for making API requests.
     */
    public function __construct()
    {
        $this->baseUrl = config('redmine.base_url');
        $this->apiKey = config('redmine.api_key');
        $this->path = $this->getPath();
    }

    /**
     * RedmineCoreService constructor
     *
     * Initializes the base URL and API key for making API requests.
     */
    abstract protected function getPath(): string;

    /**
     * Send an HTTP POST request to the Redmine API.
     *
     * @param array $params - The request parameters to be sent as JSON data.
     * @param string $type - The HTTP request type (e.g., 'POST').
     *
     * @return bool|string - The API response as a JSON string.
     */
    protected function sendRequestPost($params, $type = 'POST'): bool|string
    {
        $params = json_encode($params);
        $curl = curl_init();
        $url = $this->baseUrl . '/' . $this->path . '.json';

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $type,
            CURLOPT_POSTFIELDS => $params,
            CURLOPT_HTTPHEADER => array(
                'X-Redmine-API-Key: '.$this->apiKey,
                'Accept-Charset: utf-8',
                $this->apiKey.': X-Redmine-API-Key',
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }

    /**
     * Send an HTTP GET request to the Redmine API.
     *
     * @param int $id - The ID of the resource to retrieve.
     * @param string $type - The HTTP request type (e.g., 'GET').
     *
     * @return bool|string - The API response as a JSON string.
     */
    protected function sendRequestGet($id, $type = 'GET'): bool|string
    {
        $curl = curl_init();
        $url = $this->baseUrl . '/' . $this->path . '/'. $id. '.json';

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $type,
            CURLOPT_HTTPHEADER => array(
                'X-Redmine-API-Key: '.$this->apiKey,
                'Accept-Charset: utf-8',
                $this->apiKey.': X-Redmine-API-Key',
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }
}
