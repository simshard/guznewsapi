<?php

namespace Tests\Feature;



use App\Http\Clients\NewsClient;
use App\Services\NewsService;
use Carbon\Carbon;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Tests\Support\WorksWithNewsClient;
use Tests\TestCase;

class NewsServiceTest extends TestCase
{
    use WorksWithNewsClient;


    private $newsService;

     private $mockHandler;



    protected function setUp(): void
    {
        parent::setUp();
        $this->mockHandler=$this->setTestNewsClient();
        $this->newsService = app(NewsService::class);
    }

    /**
     * @test
     */
    public function testFetchingHeadlines():void
    {
        $this->mockHandler->append($this->mockSingleArticlesResponse());
        $results=$this->newsService->headlines();
        $this->assertCount(1,$results);
        $this->assertInstanceOf(Carbon::class, $results['article']['publishedAt']);
        $this->assertEquals('author', $results['article']['author']);
        $this->assertEquals('title', $results['article']['title']);
   }


}
