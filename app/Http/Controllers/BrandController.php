<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class BrandController extends Controller
{
    // ALL BRAND 
    public function AllBrand()
    {
        $brands = Brand::latest()->paginate(5);
        return view('admin.Brand.index', compact('brands'));
    }
    // ADD BRAND 
    public function StoreBrand(Request $request)
    {
        $validateData = $request->validate(
            [
                'brand_name' => 'required|unique:brands|max:255',
                'brand_image' => 'required|mimes:jpg.jpeg,png',
            ],
            [
                'brand_name.required' => "Please Input Brnad Name",
                'brand_image.max' => 'Brand Less Then 255Chars',
            ]
        );
        $brand_image = $request->file('brand_image');
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $img_name = $name_gen . '.' . $img_ext;
                        
        $up_location = 'image/brand/';
        $last_img = $up_location . $img_name;
        $brand_image->move($up_location, $img_name);

 
        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now()
        ]);


       
        return Redirect()->back()->with('success', 'Brand Inserted Successfully');
    }
}