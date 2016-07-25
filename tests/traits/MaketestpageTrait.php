<?php

use Faker\Factory as Faker;
use App\Models\testpage;
use App\Repositories\testpageRepository;

trait MaketestpageTrait
{
    /**
     * Create fake instance of testpage and save it in database
     *
     * @param array $testpageFields
     * @return testpage
     */
    public function maketestpage($testpageFields = [])
    {
        /** @var testpageRepository $testpageRepo */
        $testpageRepo = App::make(testpageRepository::class);
        $theme = $this->faketestpageData($testpageFields);
        return $testpageRepo->create($theme);
    }

    /**
     * Get fake instance of testpage
     *
     * @param array $testpageFields
     * @return testpage
     */
    public function faketestpage($testpageFields = [])
    {
        return new testpage($this->faketestpageData($testpageFields));
    }

    /**
     * Get fake data of testpage
     *
     * @param array $postFields
     * @return array
     */
    public function faketestpageData($testpageFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->word,
            'updated_at' => $fake->word,
            'name' => $fake->word
        ], $testpageFields);
    }
}
