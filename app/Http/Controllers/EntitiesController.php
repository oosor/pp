<?php

namespace App\Http\Controllers;

use App\Category;
use App\Entity;
use Illuminate\Http\Request;

class EntitiesController extends Controller
{
    use HelperController;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        /**
         * @var Entity $collect
         * */
        $collect = Entity::all();

        return $this->resolve('index', $collect);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();

        /**
         * @var Category $cat
         * */
        $cat = Category::find($data['cat_id']);

        if (empty($cat)) {
            return null;
        }

        $ent = new Entity();

        $ent->name = $data['name'];
        $ent->data = $data['data'];

        $cat->entities()->save($ent);

        return $this->resolve('store', $ent);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return $this->resolve('show', Entity::find($id));
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


        $data = $request->all();

        /**
         * @var Category $cat
         * */
        $cat = Category::find($data['cat_id']);

        if (empty($cat)) {
            return null;
        }

        /**
         * @var Entity $cat
         * */
        $ent = Entity::find($id);

        if (!isset($ent)) {
            return $this->reject('upd');
        }

        $ent->name = $data['name'];
        $ent->data = $data['data'];

        $cat->entities()->save($ent);

        return $this->resolve('upd', $ent);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $count = Entity::destroy($id);

        if ($count > 0) {
            return $this->resolve('del', $count);
        }

        return $this->reject('del');
    }
}
