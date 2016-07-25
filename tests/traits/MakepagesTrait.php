<?php

use Faker\Factory as Faker;
use App\Models\pages;
use App\Repositories\pagesRepository;

trait MakepagesTrait
{
    /**
     * Create fake instance of pages and save it in database
     *
     * @param array $pagesFields
     * @return pages
     */
    public function makepages($pagesFields = [])
    {
        /** @var pagesRepository $pagesRepo */
        $pagesRepo = App::make(pagesRepository::class);
        $theme = $this->fakepagesData($pagesFields);
        return $pagesRepo->create($theme);
    }

    /**
     * Get fake instance of pages
     *
     * @param array $pagesFields
     * @return pages
     */
    public function fakepages($pagesFields = [])
    {
        return new pages($this->fakepagesData($pagesFields));
    }

    /**
     * Get fake data of pages
     *
     * @param array $postFields
     * @return array
     */
    public function fakepagesData($pagesFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'content' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $pagesFields);
    }
}
