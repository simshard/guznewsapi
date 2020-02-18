<?php


namespace Tests\Support;


use App\Http\Clients\NewsClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

trait WorksWithNewsClient
{

    public function setTestNewsClient():MockHandler
    {
        $mockHandler=new MockHandler();
        $client=new NewsClient([
            'handler'=>HandlerStack::create($mockHandler),
        ]);
        $this->app->instance(NewsClient::class,$client);
        return $mockHandler;

    }



    public function mockSingleArticlesResponse()
    {
        return new Response(200, [], json_encode([
            'articles' => [
                'article' => [
                    'publishedAt'=>'2020-02-14T12:32:44Z',
                    'author' => 'author',
                    'title' => 'title',
                    'description'=>'blah blah blah...',
                    'url' => 'url',
                    'urlToImage'=>'https://ichef.bbci.co.uk/news/1024/branded_news/13299/production/_110898487_kristyna_ng_ad_02-11-20_sn8157.png',
                    'content'=>'blahbla blahbla blahbla...',

                ]
            ]
        ]));
    }
}
