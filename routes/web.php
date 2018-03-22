<?php



use App\Models\Url;
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/', function(Request $request) { 


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


});

// redirect
Route::get('/{short}', function ($short) {
	$url = Url::whereShort($short)->first();
    
    if(! $url){
    return redirect('/');
}else{
	 return redirect ($url->url);
}
});

