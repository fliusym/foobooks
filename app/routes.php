<?php

error_reporting(E_ALL);
ini_set('display_errors',1);
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*Route::get('/practice', function()
{
	//return View::make('hello');
	$fruit = Array('Apples','Oranges','Pears');
	echo Pre::render($fruit,'Fruit');
});*/

//homepage
Route::get('/foobooks',function(){

	return View::make('index');
});

//list all books /search
Route::get('/list/{format?}',function($format = 'html')
{
	$query = Input::get('query');

	$library = new Library();
	$library->setPath(app_path().'/database/books.json');
	$books = $library->getBooks();

	if($query)
	{
		$books = $library->search($query);
	}

	if($format == 'json')
	{
		return 'JSON Version';
	}
	elseif($format == 'pdf'){
		return 'PDF Version';
	}
	else{
		return View::make('list')
		->with('name','Susan')
		->with('books',$books)
		->with('query',$query);
	}
});

// Display the form for a new book
Route::get('/add', function() {

    return View::make('add');

});

// Process form for a new book
Route::post('/add', function() {


});




// Display the form to edit a book
Route::get('/edit/{title}', function() {


});

// Process form for a edit book
Route::post('/edit/', function() {


});




// Test route to load and output books
Route::get('/data', function() {

    $library = new Library();

    $library->setPath(app_path().'/database/books.json');
    
    $books = $library->getBooks();

    // Return the file
    echo Pre::render($books);

});

//test for debug info
Route::get('/debug',function(){
	echo '<pre>';
	echo '<h1>environment.php</h1>';
	$path = base_path().'/environment.php';
	try
	{
		$contents = 'Contents: '.File::getRequire($path);
		$exists = 'Yes';
	}
	catch(Exception $e)
	{
		$exists = 'No, Defaulting to `production`';
		$contents = '';
	}

	echo "Checking for: ".$path.'<br>';
	echo 'Exists: '.$exists.'<br>';
	echo $contents;
	echo '<br>';
    echo '<h1>Environment</h1>';
    echo App::environment().'</h1>';

    echo '<h1>Debugging?</h1>';
    if(Config::get('app.debug')) echo "Yes"; else echo "No";

    echo '<h1>Database Config</h1>';
    print_r(Config::get('database.connections.mysql'));

    echo '<h1>Test Database Connection</h1>';
    try {
        $results = DB::select('SHOW DATABASES;');
        echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
        echo "<br><br>Your Databases:<br><br>";
        print_r($results);
    } 
    catch (Exception $e) {
        echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
    }

    echo '</pre>';

});

