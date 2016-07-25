<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreatecategoryRequest;
use App\Http\Requests\UpdatecategoryRequest;
use App\Repositories\categoryRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class categoryController extends InfyOmBaseController {

    /** @var  categoryRepository */
    private $categoryRepository;

    public function __construct(categoryRepository $categoryRepo) {
        $this->categoryRepository = $categoryRepo;
    }

    /**
     * Display a listing of the category.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request) {
        $this->categoryRepository->pushCriteria(new RequestCriteria($request));
        $categories = $this->categoryRepository->paginate(PAGINATE);

        return view('categories.index')
                        ->with('categories', $categories);
    }

    /**
     * Show the form for creating a new category.
     *
     * @return Response
     */
    public function create() {
        return view('categories.create');
    }

    /**
     * Store a newly created category in storage.
     *
     * @param CreatecategoryRequest $request
     *
     * @return Response
     */
    public function store(CreatecategoryRequest $request) {
        $input = $request->all();
        //upload file

        $file = $request->file('image');
        if ($file != null) {
            $ext_name = $file->getClientOriginalExtension();
            $file_name = "cat-" . time() . "." . $ext_name;
            $input = ['name' => $request->input('name'), 'image' => $file_name];
            $destinationPath = 'uploads';
            $file->move($destinationPath, $file_name);
        }
        $category = $this->categoryRepository->create($input);

        Flash::success('category saved successfully.');
        return redirect(route('categories.index'));
    }

    /**
     * Display the specified category.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id) {
        $category = $this->categoryRepository->findWithoutFail($id);

        if (empty($category)) {
            Flash::error('category not found');

            return redirect(route('categories.index'));
        }

        return view('categories.show')->with('category', $category);
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id) {
        $category = $this->categoryRepository->findWithoutFail($id);

        if (empty($category)) {
            Flash::error('category not found');

            return redirect(route('categories.index'));
        }

        return view('categories.edit')->with('category', $category);
    }

    /**
     * Update the specified category in storage.
     *
     * @param  int              $id
     * @param UpdatecategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecategoryRequest $request) {
        $category = $this->categoryRepository->findWithoutFail($id);

        if (empty($category)) {
            Flash::error('category not found');

            return redirect(route('categories.index'));
        }
        $input = null;

        if (($file = $request->file('image')) != null) {
            $ext_name = $file->getClientOriginalExtension();
            $file_name = "cat-" . time() . "." . $ext_name;
            $input = ['name' => $request->input('name'), 'image' => $file_name];
            $destinationPath = 'uploads';
            $file->move($destinationPath, $file_name);
            //delete old file
            if (\File::exists(public_path() . '\uploads' . '\\' . $category->image)) {
                \File::delete(public_path() . '\uploads' . '\\' . $category->image);
            }
        } else {
            $input = ['name' => $request->input('name'), 'image' => $category->image];
        }
        $category = $this->categoryRepository->update($input, $id);
        Flash::success('category updated successfully.');

        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified category from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id) {
        $category = $this->categoryRepository->findWithoutFail($id);

        if (empty($category)) {
            Flash::error('category not found');

            return redirect(route('categories.index'));
        }

        $this->categoryRepository->delete($id);

        Flash::success('category deleted successfully.');

        return redirect(route('categories.index'));
    }

}
