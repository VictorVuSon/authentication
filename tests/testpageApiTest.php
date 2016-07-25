<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class testpageApiTest extends TestCase
{
    use MaketestpageTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatetestpage()
    {
        $testpage = $this->faketestpageData();
        $this->json('POST', '/api/v1/testpages', $testpage);

        $this->assertApiResponse($testpage);
    }

    /**
     * @test
     */
    public function testReadtestpage()
    {
        $testpage = $this->maketestpage();
        $this->json('GET', '/api/v1/testpages/'.$testpage->id);

        $this->assertApiResponse($testpage->toArray());
    }

    /**
     * @test
     */
    public function testUpdatetestpage()
    {
        $testpage = $this->maketestpage();
        $editedtestpage = $this->faketestpageData();

        $this->json('PUT', '/api/v1/testpages/'.$testpage->id, $editedtestpage);

        $this->assertApiResponse($editedtestpage);
    }

    /**
     * @test
     */
    public function testDeletetestpage()
    {
        $testpage = $this->maketestpage();
        $this->json('DELETE', '/api/v1/testpages/'.$testpage->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/testpages/'.$testpage->id);

        $this->assertResponseStatus(404);
    }
}
