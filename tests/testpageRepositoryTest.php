<?php

use App\Models\testpage;
use App\Repositories\testpageRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class testpageRepositoryTest extends TestCase
{
    use MaketestpageTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var testpageRepository
     */
    protected $testpageRepo;

    public function setUp()
    {
        parent::setUp();
        $this->testpageRepo = App::make(testpageRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatetestpage()
    {
        $testpage = $this->faketestpageData();
        $createdtestpage = $this->testpageRepo->create($testpage);
        $createdtestpage = $createdtestpage->toArray();
        $this->assertArrayHasKey('id', $createdtestpage);
        $this->assertNotNull($createdtestpage['id'], 'Created testpage must have id specified');
        $this->assertNotNull(testpage::find($createdtestpage['id']), 'testpage with given id must be in DB');
        $this->assertModelData($testpage, $createdtestpage);
    }

    /**
     * @test read
     */
    public function testReadtestpage()
    {
        $testpage = $this->maketestpage();
        $dbtestpage = $this->testpageRepo->find($testpage->id);
        $dbtestpage = $dbtestpage->toArray();
        $this->assertModelData($testpage->toArray(), $dbtestpage);
    }

    /**
     * @test update
     */
    public function testUpdatetestpage()
    {
        $testpage = $this->maketestpage();
        $faketestpage = $this->faketestpageData();
        $updatedtestpage = $this->testpageRepo->update($faketestpage, $testpage->id);
        $this->assertModelData($faketestpage, $updatedtestpage->toArray());
        $dbtestpage = $this->testpageRepo->find($testpage->id);
        $this->assertModelData($faketestpage, $dbtestpage->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletetestpage()
    {
        $testpage = $this->maketestpage();
        $resp = $this->testpageRepo->delete($testpage->id);
        $this->assertTrue($resp);
        $this->assertNull(testpage::find($testpage->id), 'testpage should not exist in DB');
    }
}
