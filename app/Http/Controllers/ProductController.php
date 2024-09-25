<?php

namespace App\Http\Controllers;

use App\Models\Product;
// use Illuminate\Container\Attributes\Storage;
use Illuminate\View\View;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

class ProductController extends Controller
{   
    public function index() : View {
        $products = Product::latest()->paginate(10);

        return view('products.index', compact('products'));
    }

    /**
     * create
     * 
     * @return view
     */

    public function create(): View {
        return view('products.create');
    }

    /**
     * store
     * 
     * @param mixed $request
     * @return RedirectResponse
     */

     public function store(Request $request): RedirectResponse {
        
        //validasi form
        $request->validate([
            'image'     => 'required|image|mimes::jpeg,jpg,png|max:2048',
            'title'     => 'required|min:5',
            'description'     => 'required|min:5',
            'price'     => 'required|numeric',
            'stock'     => 'required|numeric'
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('products', $image->hashName()); // change from 'public/products' tp 'products'

        //create product
        Product::create([
            'image' => $image->hashName(),
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock
        ]);

        //redirecct to index
        return redirect()->route('products.index')->with(['success' => 'Data berhasil disimpan!']);
     }

     public function show(string $id): View {
        //get product by ID
        $product = Product::findOrFail($id);

        //render view with product
        return view('products.show', compact('product'));
     }


     public function edit(string $id): View {
        //get product by ID
        $product = Product::findOrFail($id);

        //render view with product
        return view('products.edit', compact('product'));
     }

     /**
      * update
      *
      * @param mixed $request
      * @param mixed $id
      * @return RedirectResponse
      */

      public function update (Request $request, $id): RedirectResponse {
        //validate form
        $request->validate([
            'image'     => 'required|image|mimes::jpeg,jpg,png|max:2048',
            'title'     => 'required|min:5',
            'description'     => 'required|min:5',
            'price'     => 'required|numeric',
            'stock'     => 'required|numeric'
        ]);

        //get product by ID
        $product = Product::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('image')) {
            
            //upload new image
            $image = $request->file('image');
            $image->storeAs('products', $image->hashName());

            //delete old image
            Storage::delete('products/'.$product->image);

            //update product with new image
            $product->update([
                'image'     => $image->hashName(),
                'title'     => $request->title,
                'description'     => $request->description,
                'price'     => $request->price,
                'stock'     => $request->stock
            ]);
        } else {

            //update product without image
            $product->update([
                'title'     => $request->title,
                'description'     => $request->description,
                'price'     => $request->price,
                'stock'     => $request->stock
            ]);
        }

        //redirect to index
        return redirect()->route('products.index')->with(['success' => 'Data berhasil diubah!']);
      }

      public function destroy($id): RedirectResponse {

        //get product by ID
        $product = Product::findOrFail($id);

        //delete image
        Storage::delete('products'. $product->image);

        //delete product
        $product->delete();

        //redirect to index
        return redirect()->route('products.index')->with(['success' => 'Data berhasil diubah!']);
      }
}
