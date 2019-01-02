<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use DB;
use App\Product;
use App\Image;
use App\Type;
use App\Rating;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {
        if ($id == null)
            return view('product.index', 
                [
                    'products' => Product::paginate(10),
                    'types' => Type::all()
                ]
            );
        else
        {
            return view('product.index', 
                [
                    'products' => Product::where('type', $id)->paginate(10),
                    'typeName' => Type::find($id)->name,
                    'types' => Type::all()
                ]
            );
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create', ['types' => Type::All()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'description' => 'required',
                'cost' => 'required|numeric',
                'type' => 'required',
                'images' => 'required',
                'image.*' => '|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]
        );
        $newProduct = new Product;
        $newProduct->name = $request->input('name');
        $newProduct->description = $request->input('description');
        $newProduct->cost = $request->input('cost');
        $newProduct->type = $request->input('type');
        $newProduct->save();
        if ($request->hasFile('images'))
        {
            foreach ($request->file('images') as $image)
            {
                $newImage = new Image;
                $newImage->product = $newProduct->id;
                $imageName = md5(microtime()) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $newImage->path = $imageName;
                $newImage->save();
            }
        }
        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $comments = $product->comments()->orderBy('created_at', 'desc')->paginate(10);
        $images = $product->images;
        return view(
            'product.show', 
            [
                'product' => $product, 
                'comments' => $comments,
                'images' => $images,
                'types' => Type::all()
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $types = Type::all();
        return view('product.edit', 
            [
                'product' => $product,
                'types' => $types
            ]
        );
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
        $this->validate(
            $request,
            [
                'name' => 'required',
                'cost' => 'required',
                'type' => 'required'
            ]
        );
        $product = Product::find($id);
        $product->name = $request->input('name');
        if ($request->input('description') != null &&
            $request->input('description') != $product->description)
            $product->description = $request->input('description');
        $product->cost = $request->input('cost');
        $product->type = $request->input('type');
        $product->save();
        return redirect('/products');
    }

    /**
     * Update the rating field in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function rating(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'rating' => 'required|between:1,5|integer'
            ]
        );
        $userRating = Rating::where('user', Auth::id())->where('product', $id)->first();
        if ($userRating == null)
        {
            $userRating = new Rating;
            $userRating->user = Auth::id();
            $userRating->product = $id;
        }
        $userRating->value = $request->input('rating');
        $userRating->save();
        $product = Product::find($id);
        $statistics = Rating::select(DB::raw('count(*) as ratingcounter, avg(value) as rating'))->where('product', $id)->first();
        $product->rating = $statistics->rating;
        $product->ratingcounter = $statistics->ratingcounter;
        $product->save();
        return redirect('/products/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect('/products');
    }
}
