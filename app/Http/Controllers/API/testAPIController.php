<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatetestAPIRequest;
use App\Http\Requests\API\UpdatetestAPIRequest;
use App\Models\test;
use App\Repositories\testRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use InfyOm\Generator\Utils\ResponseUtil;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class testController
 * @package App\Http\Controllers\API
 */

class testAPIController extends InfyOmBaseController
{
    /** @var  testRepository */
    private $testRepository;

    public function __construct(testRepository $testRepo)
    {
        $this->testRepository = $testRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/tests",
     *      summary="Get a listing of the tests.",
     *      tags={"test"},
     *      description="Get all tests",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/test")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $this->testRepository->pushCriteria(new RequestCriteria($request));
        $this->testRepository->pushCriteria(new LimitOffsetCriteria($request));
        $tests = $this->testRepository->all();

        return $this->sendResponse($tests->toArray(), 'tests retrieved successfully');
    }

    /**
     * @param CreatetestAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/tests",
     *      summary="Store a newly created test in storage",
     *      tags={"test"},
     *      description="Store test",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="test that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/test")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/test"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatetestAPIRequest $request)
    {
        $input = $request->all();

        $tests = $this->testRepository->create($input);

        return $this->sendResponse($tests->toArray(), 'test saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/tests/{id}",
     *      summary="Display the specified test",
     *      tags={"test"},
     *      description="Get test",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of test",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/test"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var test $test */
        $test = $this->testRepository->find($id);

        if (empty($test)) {
            return Response::json(ResponseUtil::makeError('test not found'), 404);
        }

        return $this->sendResponse($test->toArray(), 'test retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatetestAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/tests/{id}",
     *      summary="Update the specified test in storage",
     *      tags={"test"},
     *      description="Update test",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of test",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="test that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/test")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/test"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatetestAPIRequest $request)
    {
        $input = $request->all();

        /** @var test $test */
        $test = $this->testRepository->find($id);

        if (empty($test)) {
            return Response::json(ResponseUtil::makeError('test not found'), 404);
        }

        $test = $this->testRepository->update($input, $id);

        return $this->sendResponse($test->toArray(), 'test updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/tests/{id}",
     *      summary="Remove the specified test from storage",
     *      tags={"test"},
     *      description="Delete test",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of test",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var test $test */
        $test = $this->testRepository->find($id);

        if (empty($test)) {
            return Response::json(ResponseUtil::makeError('test not found'), 404);
        }

        $test->delete();

        return $this->sendResponse($id, 'test deleted successfully');
    }
}
