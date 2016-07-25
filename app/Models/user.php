<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="user",
 *      required={email, password, name, avatar, is_admin},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="email",
 *          description="email",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="password",
 *          description="password",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="avatar",
 *          description="avatar",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="is_admin",
 *          description="is_admin",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class user extends Model
{
    use SoftDeletes;

    
    protected $dates = ['deleted_at'];


    public $fillable = [
        'email',
        'password',
        'name',
        'avatar',
        'is_admin'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'email' => 'string',
        'password' => 'string',
        'name' => 'string',
        'avatar' => 'string',
        'is_admin' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static function rules($request) {
        switch (\Request::method()) {
            case 'GET':
            case 'DELETE': {
                    return [];
                }
            case 'POST': {
                    return [
                       'email' => 'required|unique:users|email',
                        'password' => 'required|confirmed',
                        'name' => 'required',
                        'avatar' => 'required|image',
                        'is_admin' => 'required|numeric|min:0|max:1'
                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'email' => 'unique:users,id,'.$request->user()->id,
                        'password' => 'required|confirmed',
                        'name' => 'required',
                        'avatar' => 'image',
                        'is_admin' => 'required|numeric|min:0|max:1'
                    ];
                }
            default:break;
        }
    }
//    public static $rules = [
//        'email' => 'required|unique:users|email',
//        'password' => 'required|confirmed',
//        'name' => 'required',
//        'avatar' => 'required|image',
//        'is_admin' => 'required'
//    ];
}
