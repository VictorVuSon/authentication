<?php

use App\Models\pages;
use App\Repositories\pagesRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class pagesRepositoryTest extends TestCase
{
    use MakepagesTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var pagesRepository
     */
    protected $pagesRepo;

    public function setUp()
    {
        parent::setUp();
        $this->pagesRepo = App::make(pagesRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatepages()
    {
        $pages = $this->fakepagesData();
        $createdpages = $this->pagesRepo->create($pages);
        $createdpages = $createdpages->toArray();
        $this->assertArrayHasKey('id', $createdpages);
        $this->assertNotNull($createdpages['id'], 'Created pages must have id specified');
        $this->assertNotNull(pages::find($createdpages['id']), 'pages with given id must be in DB');
        $this->assertModelData($pages, $createdpages);
    }

    /**
     * @test read
     */
    public function testReadpages()
    {
        $pages = $this->makepages();
        $dbpages = $this->pagesRepo->find($pages->id);
        $dbpages = $dbpages->toArray();
        $this->assertModelData($pages->toArray(), $dbpages);
    }

    /**
     * @test update
     */
    public function testUpdatepages()
    {
        $pages = $this->makepages();
        $fakepages = $this->fakepagesData();
        $updatedpages = $this->pagesRepo->update($fakepages, $pages->id);
        $this->assertModelData($fakepages, $updatedpages->toArray());
        $dbpages = $this->pagesRepo->find($pages->id);
        $this->assertModelData($fakepages, $dbpages->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletepages()
    {
        $pages = $this->makepages();
        $resp = $this->pagesRepo->delete($pages->id);
        $this->assertTrue($resp);
        $this->assertNull(pages::find($pages->id), 'pages should not exist in DB');
    }
}
