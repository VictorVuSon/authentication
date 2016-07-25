<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class CatValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
		'title'	=>'	required|min:2',
		'content'	=>'	sometimes|min:10',
	],
        ValidatorInterface::RULE_UPDATE => [
		'title'	=>'	required|min:2',
		'content'	=>'	sometimes|min:10',
	],
   ];
}
