<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MainCategory;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorsController extends Controller
{
    public function index()
    {
        $vendores = Vendor::selection()->paginate(10);
        return view('admin.vendors.index', compact('vendores'));
    }



    public function create()
    {
        $categories = MainCategory::where('translation_of',0)->active()->get();
        return view('admin.vendors.create', compact('categories'));
    }



    public function store()
    {

    }



    public function edit()
    {

    }



    public function update()
    {

    }



    public function changeStatus()
    {

    }

}
