<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::all();
        return view('products.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'    =>  'required',
            'description'     =>  'required',
            'price'     =>  'required',
            'category_id'     =>  'required',
            'file'         =>  'image|max:2048'
        ]);

        $image = $request->file('file');

        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $new_name);
        $input_data = array(
            'name'       =>   $request->name,
            'description'        =>   $request->description,
            'price'        =>      $request->price,
            'category_id'        =>       $request->category_id,
            'file'            =>   $new_name
        );

        Product::create($input_data);

        return redirect('products')->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Product::findOrFail($id);
        return view('products.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Product::findOrFail($id);
        return view('products.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $image_name = $request->file;
        $image = $request->file('file');
        if($image != '')  // here is the if part when you dont want to update the image required
        {
            $request->validate([
                'name'    =>  'required',
                'description'     =>  'required',
                'price'     =>  'required',
                'category_id'     =>  'required',
                'file'         =>  'image|max:2048'
            ]);

            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $image_name);
        }
        else  // this is the else part when you dont want to update the image not required
        {
            $request->validate([
                'name'    =>  'required',
                'description'     =>  'required',
                'price'     =>  'required',
                'category_id'     =>  'required'
            ]);
        }
        $input_data = array(
            'name'       =>   $request->name,
            'description'        =>   $request->description,
            'price'        =>      $request->price,
            'category_id'        =>       $request->category_id,
            'file'            =>   $image_name
        );

        Product::whereId($id)->update($input_data);

        return redirect('products')->with('success', 'Product updated successfully');
    }
    
    public function destroy($id) //  here is the part for delete employee
    {
        $data = Product::findOrFail($id);
        $data->delete();

        return redirect('products')->with('error', 'Product deleted successfully');
    }
}
