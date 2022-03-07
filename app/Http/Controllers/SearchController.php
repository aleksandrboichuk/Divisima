<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\CategoryGroup;
use App\Models\ProductColor;
use App\Models\ProductMaterial;
use App\Models\ProductSeason;
use App\Models\ProductSize;
use App\Services\ElasticSearch;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index($seo_names, Request $request, ElasticSearch $elasticSearch){
        $seo_name[] = explode('/', request()->getRequestUri());
        $group = CategoryGroup::where('seo_name', $seo_name[0][2])->first();
        $products = $elasticSearch->search($request['q']);
        dd($products);
        $view = 'search.cg-search';
        foreach ($products as $key => $value){
            if($value->category_group_id == $group->id){
                $readyProducts[$key] = $value;
            }
        }
        if(!$this->getUser()){
            $cart = Cart::where('token', session('_token'))->first();
        }

        return view($view, [
            'products' => isset($readyProducts) ? $readyProducts : null,
            'colors' => ProductColor::all(),
            'group' =>  $group,
            'category' => isset($category) ? $category : null,
            "materials"=> ProductMaterial::all(),
            "seasons" => ProductSeason::all(),
            "sizes" => ProductSize::all(),
            'cart' => isset($cart) && !empty($cart) ? $cart : null,
        ]);



    }


    public function filtersRequest($seo_names, Request $request, ElasticSearch $elasticSearch ){

        //explode query string
        $mainQueryString = explode('?', request()->getRequestUri());
        $arrSeoNames = explode('/', $mainQueryString[0]); // start from 2

        $products = $elasticSearch->search($request['q']);

    }
}
