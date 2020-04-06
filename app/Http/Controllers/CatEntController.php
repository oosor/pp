<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CatEntController extends Controller
{

    public function index($id = null)
    {
        $query = Category::with(['entities']);

        if (isset($id)) {
            return $query->find($id);
        }

        return $query->get();
    }

    public function entities($id)
    {
        $ar = Category::find($id)->entities->toArray();

        return array_values(
            array_filter(
                $ar,
                function ($item) {
                    return $item['id'] != 5;
                }
            )
        );
    }

}
