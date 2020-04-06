<?php

namespace App\Http\Controllers;

use App\Category;
use App\Entity;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PPController extends Controller
{
    use HelperController;

    /**
     * Display a listing of the resource.
     *
     * @return mixed
     */
    public function index()
    {
        /**
         * @var Category $collect
         * */
        $collect = Category::all();

        return $this->resolve('index', $collect);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function store(Request $request)
    {
        if ($errors = $this->validation($request)) {
            return $this->reject('st', $errors);
        }

        $data = $request->all();

        $cat = new Category();

        $cat->name = $data['data'];
        $cat->save();

        return $this->resolve('store', $cat);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return mixed
     */
    public function show($id)
    {
        return $this->resolve('show', Category::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        if ($errors = $this->validation($request)) {
            return $this->reject('st', $errors);
        }

        /**
         * @var Category $cat
         * */
        $cat = Category::find($id);

        if (!isset($cat)) {
            return $this->reject('upd');
        }

        $data = $request->all();


        $cat->name = $data['data'];

        $cat->save();

        return $this->resolve('upd', $cat);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return mixed
     */
    public function destroy($id)
    {
//        $count = Category::destroy($id);

        $cat = Category::find($id);

        if (empty($cat)) {
            return null;
        }

        /**
         * @var \Illuminate\Support\Collection $collect
         * */
        $collect = $cat->entities;
        $collect2 = $cat->entities;

        $collect4 = $collect->filter(function ($item) {
            return $item->active;
        });

        $count = Entity::destroy($collect->pluck('id'));

        if ($count > 0) {
            $cat->delete();
            return $this->resolve('del', $count);
        }

        return $this->reject('del');
    }

    protected function validation(Request $request)
    {
        try {
            $this->validate(
                $request,
                [
                    'data' => 'required|string',
                ]
            );

            return null;
        } catch (ValidationException $exception) {
            return $exception->errors();
        }
    }
}
