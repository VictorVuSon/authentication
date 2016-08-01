<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Yajra\Datatables\Datatables;
use App\Http\Requests\CreatefoodRequest;
use App\Http\Requests\UpdatefoodRequest;
use App\Repositories\foodRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class foodController extends InfyOmBaseController {

    /** @var  foodRepository */
    private $foodRepository;

    public function __construct(foodRepository $foodRepo) {
        $this->foodRepository = $foodRepo;
    }

    /**
     * Display a listing of the food.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request) {
        $categories = \App\Models\Category::all(['id', 'name']);
        $array[''] = "";
        foreach ($categories as $cat) {
            $array[$cat->id] = $cat->name;
        }
        return view('foods.index')->with('categories', $array);
    }

    public function getIndex(Request $request) {
//        $foods = \App\Models\food::all();
        $foods = \App\Models\food::
                join('categories', 'categories.id', '=', 'foods.category_id')
                ->join('users', 'users.id', '=', 'foods.author')
                ->select('foods.id as id_food', 'foods.name as name_food', 'foods.category_id', 'users.name as author_name')
                ->where('foods.author', '=',$request->user()->id)
                ->get();
        if(\Auth::user()->id == 1){
            $foods = \App\Models\food::
                join('categories', 'categories.id', '=', 'foods.category_id')
                ->join('users', 'users.id', '=', 'foods.author')
                ->select('foods.id as id_food', 'foods.name as name_food', 'foods.category_id', 'users.name as author_name')
                ->get();
        }
        
        return Datatables::of($foods)
                        ->addColumn('action', function($food) {
                            return view('foods.actions')->with('food', $food);
                        })
                        ->editColumn('category_id', function ($food) {
                            return $food->category->name;
                        })
                        ->editColumn('name_food', '{{$name_food}}')
                        ->make(true);
    }

    /**
     * Show the form for creating a new food.
     *
     * @return Response
     */
    public function create() {
        $array = array();
        $categories = \App\Model\Category::all(['id', 'name']);
        foreach ($categories as $cat) {
            $array[$cat->id] = $cat->name;
        }
        $pass = ['categories' => $array];
        return view('foods.create')->with('pass', $pass);
    }

    /**
     * Store a newly created food in storage.
     *
     * @param CreatefoodRequest $request
     *
     * @return Response
     */
    public function store(CreatefoodRequest $request) {
        $input = $request->all();
        $input['author'] = $request->user()->id;

        $file = $request->file('image');
        $file_name = $file->getClientOriginalName();
        $ext_name = $file->getClientOriginalExtension();
        $file_name = "food-" . time() . "." . $ext_name;
        $input['image'] = $file_name;
        $food = $this->foodRepository->create($input);
        $destinationPath = 'uploads';
        $file->move($destinationPath, $file_name);


        Flash::success('food saved successfully.');

        return redirect(route('foods.index'));
    }

    /**
     * Display the specified food.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id) {
        $food = $this->foodRepository->findWithoutFail($id);
        if($this->check_food_author(\Auth::user()->id,$food->author)){
            return redirect('/foods');
        }

        if (empty($food)) {
            Flash::error('food not found');

            return redirect(route('foods.index'));
        }
        return view('foods.show')->with('food', $food);
    }

    /**
     * Show the form for editing the specified food.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id) {
        $food = $this->foodRepository->findWithoutFail($id);
        if($this->check_food_author(\Auth::user()->id,$food->author)){
            return redirect('/foods');
        }
        $array = array();
        $categories = \App\Model\Category::all(['id', 'name']);
        foreach ($categories as $cat) {
            $array[$cat->id] = $cat->name;
        }
        $pass = ['food' => $food, 'categories' => $array];
        return view('foods.edit')->with('pass', $pass);
    }

    /**
     * Update the specified food in storage.
     *
     * @param  int              $id
     * @param UpdatefoodRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatefoodRequest $request) {

        $food = $this->foodRepository->findWithoutFail($id);
        if($this->check_food_author(\Auth::user()->id,$food->author)){
            return redirect('/foods');
        }
        if (empty($food)) {
            Flash::error('food not found');

            return redirect(route('foods.index'));
        }
        $input = $request->all();
        $file = $request->file('image');
        if ($file != null) {
            $file_name = $file->getClientOriginalName();
            $ext_name = $file->getClientOriginalExtension();
            $file_name = "food-" . time() . "." . $ext_name;
            $input['image'] = $file_name;
            $destinationPath = 'uploads';
            $file->move($destinationPath, $file_name);
            //delete old file
            if (\File::exists(public_path() . '\uploads' . '\\' . $food->image)) {
                \File::delete(public_path() . '\uploads' . '\\' . $food->image);
            }
        } else {
            $input['image'] = $food->image;
        }
        $input['author'] = \Request::user()->id;
        $food = $this->foodRepository->update($input, $id);
        Flash::success('food updated successfully.');

        return redirect(route('foods.index'));
    }

    /**
     * Remove the specified food from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id) {
        $food = $this->foodRepository->findWithoutFail($id);
        if($this->check_food_author(\Auth::user()->id,$food->author)){
            return redirect('/foods');
        }
        if (empty($food)) {
            Flash::error('food not found');
            return redirect(route('foods.index'));
        }

        $this->foodRepository->delete($id);
        @(\File::delete(public_path() . '\uploads' . '\\' . $food->image));
        Flash::success('food deleted successfully.');

        return redirect(route('foods.index'));
    }
    
    public function check_food_author($id,$author){
        return($id != $author);
    }

}
