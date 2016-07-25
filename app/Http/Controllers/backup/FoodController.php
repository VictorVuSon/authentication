<?php

namespace App\Http\Controllers;

use App\Model\Food;
use Illuminate\Http\Request;
use App\Http\Requests;

class FoodController extends Controller {

    public $msg = "";

    public function index() {
      $foods =  Food::find(1)->get();
//      echo $foods->categories->name;
//      echo "ádf".$foods->name;
//      foreach($foods as $food){
//            echo $food->name;
//        }
      var_dump($foods);
//        var_dump($foods);
//        var_dump($category);
//        foreach($foods as $food){
//            echo "asdf".$food->category_id;
//        }
        die();
        return view('list-foods')->with('foods', $foods);
    }

    public function getDetail($id) {
        return Foodfind($id);
    }

    public function addForm() {
        return view('add-food');
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
        $file_name = "food-" . time() . "." . $ext;
        $food = new Food();
        $food->email = $request->input('email');
        $food->password = bcrypt($request->input('password'));
        $food->name = $request->input('fullname');
        $food->avatar = $file_name;
        $food->is_admin = $request->input('role');
        if ($food->save()) {
            $destinationPath = 'uploads';
            $file->move($destinationPath, $file_name);
            $msg = "Add successfuly";
            return redirect()->route('list-foods', compact('msg'));
        } else {
            $msg = "Erorr in adding";
            return redirect()->route('list-foods', compact('msg'));
        }
    }

    public function delete(Request $request) {
        $list_id = Input::get('check-item');
        $listFile = $this->getListFile($list_id);
        if (Fooddestroy($list_id)) {
            $msg = "Delete succsessfuly";
            foreach ($listFile as $file) {
                if (\File::exists(public_path() . '\uploads' . '\\' . $file)) {
                    \File::delete(public_path() . '\uploads' . '\\' . $file);
                } else {
                    $msg = "Avatar not exist";
                    echo redirect()->route('list-foods', compact('msg'));
                }
            }
            return redirect()->route('list-foods', compact('msg'));
        } else {
            $msg = "No delete";
            return redirect()->route('list-foods', compact('msg'));
        }
    }

    public function getListFile($list_id) {
        if (count($list_id) > 0) {
            return (Foodfind($list_id)->pluck('avatar'));
        }
    }

    public function editForm($id) {
        $food = $this->getDetail($id);
        return view('edit-food')->with('user', $food);
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
            $food = Foodfind($id);
            $file = $request->file('avatar');
            $old_name = $food->avatar;
            if ($file != null) {
                $file_name = $file->getClientOriginalName();
                $pieces = explode(".", $file_name);
                $ext = end($pieces);
                $file_name = "food-" . time() . "." . $ext;
                $food->avatar = $file_name;
                $destinationPath = 'uploads';
                $file->move($destinationPath, $file_name);
                if (\File::exists(public_path() . '\uploads' . '\\' . $old_name)) {
                    \File::delete(public_path() . '\uploads' . '\\' . $old_name);
                }
            }
            $food->password = bcrypt($request->input('password'));
            $food->name = $request->input('fullname');
            $food->is_admin = $request->input('role');
            if ($food->save()) {
                $msg = "Edit successfuly";
                return redirect()->route('list-foods', array('id' => $id, 'msg' => $msg));
            } else {
                $msg = "Error in updating";
                return redirect()->route('edit-food', array('id' => $id, 'msg' => $msg));
            }
        } else {
            $msg = "The old password is invalid";
            return redirect()->route('edit-food', array('id' => $id, 'msg' => $msg));
        }
    }

    public function checkOldPass($id, $old_password) {
        $current_pass = Foodfind($id)->pluck('password');
        if (\Hash::check($old_password, $current_pass[0])) {
            return true;
        } else {
            return false;
        }
    }

}
