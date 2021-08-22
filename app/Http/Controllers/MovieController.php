<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use function PHPSTORM_META\map;
class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     
    public function index()
    {
        $base='https://api.themoviedb.org/3/';
        $key='4ec327e462149c3710d63be84b81cf4f';
        
         $resp =Http::get($base.'trending/movie/week?api_key='.$key.'&language=pt-BR')
         ->json()["results"];
          // funçao para ordenar os filmes pelo title
          function sort($arr){
            array_multisort(array_map(function($element){
                return $element['title'];
            },$arr),SORT_ASC,$arr);
            return $arr;
         }
         $movies=sort($resp);
       
        $genres_arr= Http::get($base.'genre/movie/list?api_key='.$key.'&language=pt-BR')
        ->json()["genres"];
        
        $genres=collect($genres_arr)->mapWithKeys(function($genre){
            return [$genre['id'] =>$genre['name']];
        });
         
         return view('index',['movies'=>$movies,'genres'=>$genres]);
    }

    public function show($id)
    {
        $base='https://api.themoviedb.org/3/';
        $key='4ec327e462149c3710d63be84b81cf4f';
        $resp= Http::get($base.'movie/'.$id.'?api_key='.$key.'&append_to_response=credits&language=pt-BR')->json();
        //dd($resp);
       
        return View("detalhes",['movie'=>$resp]);
    }

  
    public function busca(Request $request)
    {
        $base='https://api.themoviedb.org/3/';
        $key='4ec327e462149c3710d63be84b81cf4f';

        $nome=$request->filme;
        $resp=Http::get($base.'search/movie?api_key='.$key.'&language=pt-BR&query='.$nome.'&page=1&include_adult=false')
        ->json()['results'];
        
        $genres_arr= Http::get($base.'genre/movie/list?api_key='.$key.'&language=pt-BR')
        ->json()["genres"];
        
        $genres=collect($genres_arr)->mapWithKeys(function($genre){
            return [$genre['id'] =>$genre['name']];
        });
       
       return view("busca",['movies'=>$resp,'genres'=>$genres]);
        
        
    }

    
}
