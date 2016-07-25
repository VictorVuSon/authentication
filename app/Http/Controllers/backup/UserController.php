<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Users;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Collection;

class UserController extends Controller {

    public $msg = "";

    public function index() {
        $users = Users::all();
        return view('list-users')->with('users', $users);
    }

    public function getDetail($id) {
        return Users::find($id);
    }

    public function addForm() {
        return view('add-user');
    }

    public function addAction(Request $request) {

        $this->validate($request, [
            'email' => 'required|max:255|email|unique:users,email',
            'fullname' => 'required|max:30',
            'password' => 'required|max:60|confirmed',
            'password_confirmation' => 'required',
            'avatar' => 'image|required|max:20000',
        ]);
        $file = $request->file('avatar');
        $file_name = $file->getClientOriginalName();
        $pieces = explode(".", $file_name);
        $ext = end($pieces);
        $file_name = "foody-" . time() . "." . $ext;
        $user = new Users();
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->name = $request->input('fullname');
        $user->avatar = $file_name;
        $user->is_admin = $request->input('role');
        if ($user->save()) {
            $destinationPath = 'uploads';
            $file->move($destinationPath, $file_name);
            $msg = "Add successfuly";
            return redirect()->route('list-users', compact('msg'));
        } else {
            $msg = "Erorr in adding";
            return redirect()->route('list-users', compact('msg'));
        }
    }

    public function delete(Request $request) {
        $list_id = Input::get('check-item');
        $listFile = $this->getListFile($list_id);
        if (Users::destroy($list_id)) {
            $msg = "Delete succsessfuly";
            foreach ($listFile as $file) {
                if (\File::exists(public_path() . '\uploads' . '\\' . $file)) {
                    \File::delete(public_path() . '\uploads' . '\\' . $file);
                } else {
                    $msg = "Avatar not exist";
                    echo redirect()->route('list-users', compact('msg'));
                }
            }
            return redirect()->route('list-users', compact('msg'));
        } else {
            $msg = "No delete";
            return redirect()->route('list-users', compact('msg'));
        }
    }

    public function getListFile($list_id) {
        if (count($list_id) > 0) {
            return (Users::find($list_id)->pluck('avatar'));
        }
    }

    public function editForm($id) {
        $user = $this->getDetail($id);
        return view('edit-user')->with('user', $user);
    }

    public function editAction($id, Request $request) {
        $this->validate($request, [
            'fullname' => 'required|max:30',
            'old_password' => 'required|max:60',
            'password' => 'required|confirmed|max:60',
            'password_confirmation' => 'required|max:60',
            'avatar' => 'image|max:20000',
        ]);
        if ($this->checkOldPass($id, $request->input('old_password'))) {
            $user = Users::find($id);
            $file = $request->file('avatar');
            $old_name = $user->avatar;
            if ($file != null) {
                $file_name = $file->getClientOriginalName();
                $pieces = explode(".", $file_name);
                $ext = end($pieces);
                $file_name = "foody-" . time() . "." . $ext;
                $user->avatar = $file_name;
                $destinationPath = 'uploads';
                $file->move($destinationPath, $file_name);
                if (\File::exists(public_path() . '\uploads' . '\\' . $old_name)) {
                    \File::delete(public_path() . '\uploads' . '\\' . $old_name);
                }
            }
            $user->password = bcrypt($request->input('password'));
            $user->name = $request->input('fullname');
            $user->is_admin = $request->input('role');
            if ($user->save()) {
                $msg = "Edit successfuly";
//                echo $msg;
//                die();
                return redirect()->route('list-users', array('id' => $id, 'msg' => $msg));
            } else {
                $msg = "Error in updating";
                echo $msg;
                die();
                return redirect()->route('edit-user', array('id' => $id, 'msg' => $msg));
            }
        } else {
            $msg = "The old password is invalid";
//            return redirect()->action('UserController@editForm', ['id' => $id]);
            return redirect()->route('edit-user', array('id' => $id, 'msg' => $msg));
        }
    }

    public function checkOldPass($id, $old_password) {
        $current_pass = Users::find($id)->pluck('password');
        if (\Hash::check($old_password, $current_pass[0])) {
            return true;
        } else {
            return false;
        }
    }

}
