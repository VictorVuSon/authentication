<?php

namespace App\Http\Controllers;

use Yajra\Datatables\Datatables;
use Gate;
use App\Models\user;
use App\Http\Requests;
use App\Http\Requests\CreateuserRequest;
use App\Http\Requests\UpdateuserRequest;
use App\Repositories\userRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class userController extends InfyOmBaseController {

    /** @var  userRepository */
    private $userRepository;
    private $request;

    public function __construct(userRepository $userRepo, Request $request) {
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the user.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request) {
        return view('users.index');
    }
    public function getIndex() {
        $users = user::all(['id', 'name', 'email','is_admin']);
        return Datatables::of($users)
                        ->addColumn('action', function($user) {
                            return view('users.actions')->with('user', $user);
                        })
                        ->editColumn('name', '{{$name}}')
                        ->editColumn('email', '{{$email}}')
                        ->editColumn('is_admin', '@if($is_admin == 1) Admin @else User @endif')        
                        ->make(true);
    }

    /**
     * Show the form for creating a new user.
     *
     * @return Response
     */
    public function create() {
        return view('users.create');
    }

    /**
     * Store a newly created user in storage.
     *
     * @param CreateuserRequest $request
     *
     * @return Response
     */

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateuserRequest $request) {
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        //upload file
        $file = $request->file('avatar');
        if ($file != null) {
            $ext_name = $file->getClientOriginalExtension();
            $file_name = "user-" . time() . "." . $ext_name;
            $input['avatar'] = $file_name;
            $destinationPath = 'uploads';
            $file->move($destinationPath, $file_name);
        }
        $user = $this->userRepository->create($input);

        Flash::success('user saved successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Display the specified user.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id) {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('user not found');

            return redirect(route('users.index'));
        }

        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id) {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('user not found');

            return redirect(route('users.index'));
        }

        return view('users.edit')->with('user', $user);
    }

    /**
     * Update the specified user in storage.
     *
     * @param  int              $id
     * @param UpdateuserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateuserRequest $request) {
        $user = $this->userRepository->findWithoutFail($id);
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['email'] = $user->email;
        if (empty($user)) {
            Flash::error('user not found');

            return redirect(route('users.index'));
        }
        if (($file = $request->file('avatar')) != null) {
            $ext_name = $file->getClientOriginalExtension();
            $file_name = "user-" . time() . "." . $ext_name;
//            $input = ['name' => $request->input('name'), 'image' => $file_name];
            $input['avatar'] = $file_name;
            $destinationPath = 'uploads';
            $file->move($destinationPath, $file_name);
            //delete old file
            if (\File::exists(public_path() . '\uploads' . '\\' . $category->image)) {
                \File::delete(public_path() . '\uploads' . '\\' . $category->image);
            }
        } else {
            $input['avatar'] = $user->avatar;
        }
        $user = $this->userRepository->update($input, $id);

        Flash::success('user updated successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id) {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('user not found');

            return redirect(route('users.index'));
        }

        $this->userRepository->delete($id);

        Flash::success('user deleted successfully.');

        return redirect(route('users.index'));
    }

}
