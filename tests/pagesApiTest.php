<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class pagesApiTest extends TestCase
{
    use MakepagesTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatepages()
    {
        $pages = $this->fakepagesData();
        $this->json('POST', '/api/v1/pages', $pages);

        $this->assertApiResponse($pages);
    }

    /**
     * @test
     */
    public function testReadpages()
    {
        $pages = $this->makepages();
        $this->json('GET', '/api/v1/pages/'.$pages->id);

        $this->assertApiResponse($pages->toArray());
    }

    /**
     * @test
     */
    public function testUpdatepages()
    {
        $pages = $this->makepages();
        $editedpages = $this->fakepagesData();

        $this->json('PUT', '/api/v1/pages/'.$pages->id, $editedpages);

        $this->assertApiResponse($editedpages);
    }

    /**
     * @test
     */
    public function testDeletepages()
    {
        $pages = $this->makepages();
        $this->json('DELETE', '/api/v1/pages/'.$pages->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/pages/'.$pages->id);

        $this->assertResponseStatus(404);
    }
}
