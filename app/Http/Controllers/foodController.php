<?php

namespace App\Http\Controllers;

use App\Http\Requests;
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
//        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $array = array();
        $name = null;
        $id_cat = null;
        if(isset($_GET['name'])){
            $name = $_GET['name'];
        }
        if(isset($_GET['cat'])){
            $id_cat = $_GET['cat'];
        }
        if($name || $id_cat)
        {
            $foods = \App\Model\Food::where('name','like', '%'.$name.'%')->where('category_id', $id_cat)->get();
//            $foods = $this->foodRepository->paginate(PAGINATE);
        }
        else{
            $this->foodRepository->pushCriteria(new RequestCriteria($request));
            $foods = $this->foodRepository->all();
        }
        $categories = \App\Model\Category::all(['id', 'name']);
        foreach ($categories as $cat) {
            $array[$cat->id] = $cat->name;
        }
        
        return view('foods.index')
                        ->with('foods', $foods)
                        ->with('categories',$array);
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
        if (\Gate::denies('author_food', \Auth::user(),$food)) {
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
        if (\Gate::denies('author_food', \Auth::user(),$food)) {
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
        if (\Gate::denies('author_food', \Auth::user(),$food)) {
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
        if (\Gate::denies('author_food', \Auth::user(),$food)) {
            return redirect('/foods');
        }
        if (empty($food)) {
            Flash::error('food not found');

            return redirect(route('foods.index'));
        }

        $this->foodRepository->delete($id);

        Flash::success('food deleted successfully.');

        return redirect(route('foods.index'));
    }
    public function executeSearch(){
        $keywords = \Illuminate\Support\Facades\Input::get('keywords');
        echo $keywords;die();
        $foods = \App\Model\Food::all();
        $searchFoods = new \Illuminate\Database\Eloquent\Collection();
        foreach($foods as $f){
             if(\Illuminate\Support\Str::contains(\Illuminate\Support\Str::lower($f->name), \Illuminate\Support\Str::lower($keywords)))
                     $searchFoods->add ($u);
        }
        return View::make('searchFoods')->with('searchFoods',$searchFoods);
    }

}
