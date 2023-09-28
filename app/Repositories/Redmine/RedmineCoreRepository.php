<?php
namespace App\Repositories\Redmine;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

abstract class RedmineCoreRepository
{
    /**
     * @var Model
     */
    protected $path;
    protected $baseUrl;
    protected $apiKey;

    /**
     * CoreRepository constructor
     */
    public function __construct()
    {
        $this->baseUrl = config('redmine.base_url');
        $this->apiKey = config('redmine.api_key');
        $this->path = $this->getPath();
    }

    /**
     * @return string
     */
    abstract protected function getPath(): string;

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Model|mixed
     */
    protected function getData($queryString = null, $path = null): mixed
    {
        $url = $this->baseUrl . '/'.$this->path.'.json';
        if($queryString){
            $url .= '?' . $queryString;
        }
        if($path){
            $url = $path;
        }
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'X-Redmine-API-Key: '.$this->apiKey,
                'Accept-Charset: utf-8',
                $this->apiKey.': X-Redmine-API-Key',
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response, true);

        return $response;
    }

    protected function pagination($data, $page = 1): LengthAwarePaginator
    {
        $perPage = $data['limit'];
        $results = array_slice($data[$this->path], ($page - 1) * $perPage, $perPage);

        $paginator = new LengthAwarePaginator(
            $results,
            $data['total_count'],
            $perPage,
            $page,
            [
                'path' => Paginator::resolveCurrentPath(),
            ]
        );

        return $paginator;
    }
}
