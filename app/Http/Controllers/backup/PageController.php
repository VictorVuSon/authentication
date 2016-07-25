<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Model\Page;
class PageController extends Controller {

    public $msg = "";

    public function index() {
        $pages = Page::all();
        return view('list-pages')->with('pages', $pages);
    }

    public function getDetail($id) {
        return Page::find($id);
    }

    public function addForm() {
        return view('add-page');
    }

    public function addAction(Request $request) {

        $this->validate($request, [
            'name' => 'required|max:255',
            'content' => 'required',
        ]);
        $page = new Page();
        $page->name = $request->input('name');
        $page->content = $request->input('content');
        if ($page->save()) {
            $msg = "Add successfuly";
            return redirect()->route('list-pages', compact('msg'));
        } else {
            $msg = "Erorr in adding";
            return redirect()->route('list-pages', compact('msg'));
        }
    }

    public function delete(Request $request) {
        $list_id = $request->get('check-item');
        if (Page::destroy($list_id)) {
            $msg = "Delete succsessfuly";
            return redirect()->route('list-pages', compact('msg'));
        } else {
            $msg = "No delete";
            return redirect()->route('list-pages', compact('msg'));
        }
    }
    public function editForm($id) {
        $page = $this->getDetail($id);
        return view('edit-page')->with('page', $page);
    }

    public function editAction($id, Request $request) {
        $this->validate($request, [
            'name' => 'required|max:255',
            'image' => 'image|max:20000',
        ]);
        $page = Page::find($id);
        
        $page->name = $request->input('name');
        $page->content = $request->input('content');
        if ($page->save()) {
            $msg = "Edit successfuly";
            return redirect()->route('list-pages', array('id' => $id, 'msg' => $msg));
        } else {
            $msg = "Error in updating";
            echo $msg;
            die();
            return redirect()->route('edit-page', array('id' => $id, 'msg' => $msg));
        }
    }

}
