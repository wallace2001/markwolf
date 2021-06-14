<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product as ModelsProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Validator;
use Product;

class ProductController extends Controller
{

    protected $user;

    public function __construct()
    {
        $this->user = Auth()->guard('api')->user();
    }

    public function index()
    {
        $product = ModelsProduct::all();
        return $product;
    }

    public function store(Request $request)
    {

        if(!$this->user){
            // redirect('/');
            return response()->json(['error' => "Usuário não encontrado!"]);
        }

        $validator = Validator::make($request->all(), [
            "name" => ["string", "max:255", "required", "unique:products"],
            "description" => ["string", "required"]
            // "image" => ["string", "required"]
        ]);

        if($validator->fails()){
            return response()->json(["error", $validator->errors()], 200);
        }

        $product = new ModelsProduct();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->size_id = $request->size_id;
        $product->image = $request->image;
        $product->save();

        if($product->id){
            return response()->json($product, 200);
        }

        return response()->json(["error", "Erro ao criar produto!"]);
    }

    public function show($id)
    {
        $product = ModelsProduct::where('id', $id)->first();
        if(!$product){
            return response()->json(['message' => 'Produto não encontrado.']);
        }
        return $product;
    }

    public function update(Request $request, $id)
    {

        if(!$this->user){
            return response()->json(["error" => "Usuário não identificado."]);
        }
        $product = ModelsProduct::where("id", $id)->first();

        // return $request->all();

        $productUpdate = ModelsProduct::find($id);
        $productUpdate->update([
            'name' => $request->name ? $request->name : $product->name,
            'description' => $request->description ? $request->description : $product->description,
            'size_id' => $request->size_id ? $request->size_id : $product->size_id,
            'category_id' => $request->category_id ? $request->category_id : $product->category_id,
            'image' => $request->image ? $request->image : $product->image,
            'updated_at' => new Date(),
            'created_at' => $product->create_at
        ]);
        // $productUpdate->save();

        return response()->json($productUpdate);
    }

    public function destroy($id)
    {
        $product = ModelsProduct::find($id);
        $product->delete();
        return response()->json("Produto deletado com sucesso!");
    }
}
