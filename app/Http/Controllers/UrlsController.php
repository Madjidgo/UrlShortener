<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UrlsController extends Controller
{
    public function create()
    {
    	 return view('welcome');
    }

    public function store(Request $request)
    {

// validation url


		$urlVerif = request('url');	
		$request->flash();

		Validator::make(compact('urlVerif'),[
			'urlVerif' => 'required|url'])->validate();
			
		//Verifier si l'url à déja été crée
		$url = Url::whereUrl(request('url'))->first();
		if($url){
			return view('result')->withShort( $url->short);
		}

		// create
		function get_unique_short(){
			$short = str_random(7);
			if(Url::whereShort($short)->count() != 0){
				return get_unique_short();
		}else{
			return $short;
		}
		}

		$row = Url::create([
			'url'=>request('url'),
			'short' => get_unique_short()
			]);

		if($row){
			return view('result')->withShort( $row->short);
		}



    }

    public function show($short){
    	$url = Url::whereShort($short)->first();
    
    if(! $url){
    return redirect('/');
}else{
	 return redirect ($url->url);
}
 

    }

}
