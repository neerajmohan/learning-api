<?php

namespace App\Http\Controllers;

use Alaouy\Youtube\Facades\Youtube;

use App\Repositories\Interfaces\ProductsRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Product\product;

class ProductController extends Controller
{
    //
    private $productsRepository;

    public function __construct(ProductsRepositoryInterface $productsRepository)
    {
        $this->productsRepository = $productsRepository;
    }
    
    public function index () {
        return $this->productsRepository->index();
    }

    public function show($id){
        try{
            return $this->productsRepository->show($id);
        }catch(ProductNotFoundException $exception){
            report($exception);
        }
    }

    public function store(Request $request){
        return $this->productsRepository->store($request);
    
    }

    public function update(Request $request, $id){

    return $this->productsRepository->update($request,$id);
    }

    public function delete(Request $request,$id){
        return $this->productsRepository->delete($request,$id);

    }
    public function youtube(Request $request){
        return json_encode(Youtube::getVideoInfo(strval($request->data)));
    }   
}
