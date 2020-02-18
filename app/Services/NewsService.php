<?php


namespace App\Services;

use \App\Http\Clients\NewsClient;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;


class NewsService
{
    /**
     * NewsService constructor.
     * @param NewsClient $client
     */
    private $client;
    public function __construct(NewsClient $client)
    {
        $this->client=$client;
    }
    public function headlines():Collection
    {
        $response= $this->client->get('top-headlines?sources=bbc-news');
        $body=json_decode((string)$response->getBody(),true);
        //convert to collection
        $collection=collect($body['articles'])->map(
            function ($article) {
                return [
                    'author'=>$article['author'],
                    'title'=>$article['title'],
                    'description'=>$article['description'],
                    'url'=>$article['url'],
                    'urlToImage'=>$article['urlToImage'],
                    'content'=>$article['content'],
                    'publishedAt'=>$article['publishedAt']!==null
                        ?Carbon::createFromFormat('Y-m-d\TH:i:s\Z', $article['publishedAt']):'unknown',
                ];
            }
        );

        return $collection;
    }

}
