<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImportController;
/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});


// $router->post('mcq-import', [
//     'as' => 'mcq-import', 'uses' => 'ImportController@store'
// ]);

$router->group(['prefix' => 'api'], function () use ($router) {

    $router->post('/register', 'AuthController@register');
    $router->post('/login', 'AuthController@login');

    $router->group(['middleware' => 'auth'], function () use ($router) {
        
        $router->post('/logout', 'AuthController@logout');

        $router->post('create-answer', 'ResultController@store');

        $router->post('import-mcq', 'MCQController@import');

        $router->get('all-mcq', 'MCQController@all');
        $router->get('show/{id}', 'MCQController@show');
        $router->get('delete/{id}', 'MCQController@delete');
    });
    
    
    // $router->post('create-mcq', 'MCQController@store');
    
    // $router->post('create-book', 'BookController@store');
    
    // $router->post('create-pdf', 'BookPDFController@store');
    
    // $router->post('import-pdf', 'BookPDFController@import');
    
    // $router->post('create-exam', 'ExamController@store');
    
    // $router->post('create-latest-topic', 'LatestTopicController@store');
    
    // $router->post('create-topic', 'TopicController@store');

    // $router->get('/home', 'AppApiController@home');
    // $router->get('/topic/{topic_id}/pdf', 'AppApiController@topicPdfList');
    // $router->get('/exam/{exam_id}/questions', 'AppApiController@examQuestions');
});

// Route::post('mcq-import',[\App\Http\Controllers\MCQController::class,'store'])->name('mcq-import');


// php -S localhost:8000 -t ./public

