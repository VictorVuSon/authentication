<?php

namespace App\Repositories;

use App\Models\test;
use InfyOm\Generator\Common\BaseRepository;

class testRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'other'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return test::class;
    }
}
