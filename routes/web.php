<?php

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
use \App\Survey;
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/list', function() {
  $surveys = Survey::with('responses')->get();
  //$surveys = Survey::all();
  return view('survey.list', ['surveys'=>$surveys]);
})->middleware('auth');

Route::get('/home', 'HomeController@index');
Route::get('/thanks', function() {
  return view('survey.thanks');
});
Route::get('/new', function() {
  return view('survey.new');
})->middleware('auth');
Route::post('/survey/create', 'SurveyController@create')->middleware('auth');
Route::get('/survey/edit/{survey}', 'SurveyController@editSurveyForm')->middleware('auth');
Route::post('/survey/edit/{survey}', 'SurveyController@editSurvey')->middleware('auth');

Route::get('/survey/code/{survey}', function(Survey $survey) {
  return view('survey.form-html', ['survey'=>$survey]);
})->middleware('auth');

Route::get('/survey/{id}', 'SurveyController@show');
Route::post('/survey/submit/{id}', 'SurveyController@submit');
Route::get('/addquestion/{survey}', function(Survey $survey) {
  return view('survey.addquestion', ['survey'=>$survey]);
})->middleware('auth');
Route::post('/addquestion/{survey}', 'SurveyController@addquestion');

Route::get('/response/process/{survey_response}', 'ResponseController@process');
Route::get('/response/export/{survey}', 'ResponseController@export')->middleware('auth');
Route::get('/response/csv/{survey}', 'ResponseController@exportCsv')->middleware('auth');
Route::get('/response/single/{survey_response_id}', 'ResponseController@single')->middleware('auth');
Route::get('/response/next/{survey_response}', 'ResponseController@next')->middleware('auth');
Route::get('/response/{survey_id}', 'ResponseController@show')->middleware('auth');

Route::get('/thanks/{survey}', function(Survey $survey) {
  return view('survey.thanks', ['survey'=>$survey]);
});

Route::any('{all}', function( $page ){
  $survey = Survey::named($page);
  if($survey) {
    return view('survey.form', ['survey'=>$survey]);
  } else {
    abort(404);
  }
});
