<?php

namespace App\Http\Controllers;

use App\Entity;
use Illuminate\Http\Request;

class EntCatController extends Controller
{
    public function index($id = null)
    {
        $query = Entity::with('category');

        if (isset($id)) {
            return $query->find($id);
        }

        return $query->get();
    }
}
