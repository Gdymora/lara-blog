<?php
/*
|--------------------------------------------------------------------------
| Маршруты приложения
|--------------------------------------------------------------------------
|
| Здесь вы можете зарегистрировать все маршруты для приложения.
| Это очень просто. Просто укажите URI, на которые она должна отвечать 
| и дайте её контроллеру для вызова, когда запрошен этот URI.
|
*/
Route::get('/','PostController@index');

Auth::routes();
Route::get('/home',['as' => 'home', 'uses' => 'PostController@index']);
//authentication
// проверка залогиненного пользователя
Route::group(['middleware' => ['auth']], function()
{
 // показ новой пост формы
 Route::get('new-post','PostController@create');
 // сохранение нового поста
 Route::post('new-post','PostController@store');
 // редактирование формы поста
 Route::get('edit/{slug}','PostController@edit');
 // обновление поста
 Route::post('update','PostController@update');
 // удаление поста
 Route::get('delete/{id}','PostController@destroy');
 // вывод всех постов пользователю
 Route::get('my-all-posts','UserController@user_posts_all');
 // вывод пользовательских черновиков
 Route::get('my-drafts','UserController@user_posts_draft');
 // добавление комментариев
 Route::post('comment/add','CommentController@store');
 // удаление комментария
 Route::post('comment/delete/{id}','CommentController@distroy');
});
// пользовательские профили
Route::get('user/{id}','UserController@profile')->where('id', '[0-9]+');
// вывод списка постов
Route::get('user/{id}/posts','UserController@user_posts')->where('id', '[0-9]+');
// вывод одного поста
Route::get('/{slug}',['as' => 'post', 'uses' => 'PostController@show'])->where('slug', '[A-Za-z0-9-_]+');
