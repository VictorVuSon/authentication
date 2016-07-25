<?php

namespace App\Repositories;

use App\Models\user;
use InfyOm\Generator\Common\BaseRepository;

class userRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'email',
        'name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return user::class;
    }
}
