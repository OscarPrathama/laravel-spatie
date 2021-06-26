<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Exports\ProductsExport;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;
use Auth;

class ProductController extends Controller
{
    function __construct(){
        $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','show']]);
        $this->middleware('permission:product-create', ['only' => ['create','store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }

    public function index(){
        // $products = Product::latest()->paginate(5);
        // return view('products.index',compact('products'))->with('i', (request()->input('page', 1) - 1) * 5);

        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create(){
        return view('products.create');
    }

    public function store(Request $request){
        request()->validate([
            'post_title' => 'required',
        ]);

        Product::create([
            'post_title' => $request->post_title,
            'post_slug' => Str::slug($request->post_title),
            'post_content' => $request->post_content,
        ]);
        return redirect()->route('products.index')->with('success','Product created.');
    }

    public function show(Product $product){
        return view('products.show', compact('product'));
    }

    public function edit(Product $product){
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product){
        request()->validate([
            'post_title' => 'required',
        ]);

        $product->update([
            'post_title' => $request->post_title,
            'post_slug' => Str::slug($request->post_title),
            'post_content' => $request->post_content
        ]);

        return redirect()->route('products.index')->with('success','Product updated');
    }

    public function destroy(Product $product){
        $product->delete();
        return redirect()->route('products.index')->with('success','Product deleted');
    }

    public function exportToExcel(){
        return Excel::download(new ProductsExport, 'Products.xlsx');
    }

    public function productAPI(){
        $products = Product::select(['id', 'post_title', 'created_at']);

        $results = Datatables::of($products)
                    ->addColumn('action', function ($product) {
                        $user = Auth::user();
                        if ($user->can('product-edit')){
                            return
                                '
                                <a href="'.route('products.show', $product->id).'" class="btn btn-xs btn-dark">
                                    View
                                </a>
                                <a href="'.route('products.edit', $product->id).'" class="btn btn-xs btn-success">
                                    Edit
                                </a>
                                <a href="'.route('products.delete', $product->id).'" class="btn btn-xs btn-danger">
                                    Delete
                                </a>
                            ';
                        }else{
                            return
                                '
                                <a href="'.route('products.show', $product->id).'" class="btn btn-xs btn-dark">
                                    View
                                </a>
                            ';
                        }

                    })
                    ->editColumn('id', '{{$id}}')
                    ->make(true);
                    // ->toJson();
        return $results;
    }

}
