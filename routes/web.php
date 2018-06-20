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

Route::get('/','WebController@index');


//Filters

	Route::get('filter/document/date/{id}/{date?}','DocumentFilterController@filter_document_created_at');

	Route::get('filter/document/content/{id}/{office?}','DocumentFilterController@filter_document_content');

	Route::get('filter/document/category/{id}','DocumentFilterController@filter_document_category');

	Route::get('filter/document/{id}/{document}/{office?}','DocumentFilterController@filter_document');

	Route::get('filters/document/{id}/{document}/{office}/{date}','DocumentFilterController@filter_full');

	Route::get('document/{file}','AdminDocumentController@document_download')->name('document/application');

	//Route::get('preview')



//End Filter



Route::post('login/auth','LoginController@authenticate');

Route::middleware(['admin'])->group(function(){

	//Admin Views Controller

	Route::get('admin/document/category','AdminViewController@category_document_view')->name('category_document');

	Route::get('admin/documents','AdminViewController@create_document_view')->name('create_document');

	Route::get('admin/document/create','AdminViewController@create_document')->name('document_create');

	Route::get('admin/request/document','AdminViewController@document_request')->name('document/request');

	Route::get('admin/tracking/document','AdminViewController@tracking_view')->name('document/tracking');

	Route::get('admin/dashboard','AdminViewController@admin_view')->name('admin/dashboard');

	Route::get('admin/request/update/{id?}','AdminViewController@update_request');

	//End Views Controller

	//Document Category Store Update Ajax get
	
	Route::post('admin/document/registry','DocumentCategoryController@validate_document_category')->name('register/document');

	Route::post('admin/document/update/{id}','DocumentCategoryController@validate_document_category');

	Route::get('admin/document/{id}','DocumentCategoryController@ajax_document_category_update');

	Route::get('document/category/delete/{id}','DocumentCategoryController@soft_delete_document_category');

	Route::get('document/category/recover/{id}','DocumentCategoryController@recover_document_category');

	//End Category Store Update And Ajax Get

	//Document Store and Update Ajax get

	Route::post('admin/create/document','AdminDocumentController@create_document')->name('document/create');

	Route::get('update/created/document/{id}','AdminDocumentController@updated_created_document');

	Route::post('update/created/document/{id}','AdminDocumentController@create_document');

	Route::get('document/delete/{id}','AdminDocumentController@document_soft_delete');

	Route::get('document/recover/{id}','AdminDocumentController@recover_document');

	//End Document Store And Update Ajax get

	//Request Documents Store Update Ajax Get


	Route::post('admin/document/request/validate','DocumentRequestController@validate_request_document')->name('request/document');

	Route::get('admin/request/approved','DocumentRequestController@document_approved')->name('document/request/approved');

	Route::get('request/document/delete/{id}','DocumentRequestController@request_action');

	Route::get('request/document/recover/{id}','DocumentRequestController@request_action');

	Route::post('admin/update/request/validate/{id}','DocumentRequestController@validate_request_document');

	Route::get('remove/document/request/{id}','DocumentRequestController@replace_document_request');

	Route::get('request/document/approval/{id}','DocumentRequestController@ajax_get_request');

	//End Request Document Store Update Ajax Get

	//Tracking Document

	Route::post('admin/document/request/tracking/{id}','DocumentTrackingController@document_tracking_validate');

	//End Tracking

	Route::get('storage/app/public/documents/{any}/{id}','AdminDocumentController@display_pdf');

	//User Request

	Route::get('admin/request/user/{id}','AdminViewController@update_user_request');

	Route::post('admin/user/document/request/{id}','AdminDocumentController@update_user_request');


	//End User Request

});


Route::middleware(['receiver'])->group(function(){

	Route::get('receiver/dashboard','ReceiverViewController@receiver_dashboard')->name('receiver/dashboard');

	//documents

		Route::get('receiver/documents','ReceiverViewController@receiver_document')->name('receiver/documents');

		Route::post('receiver/document/get/{id}/{any?}','ReceiverViewController@receiver_ajax_document');

		Route::get('receiver/documents/received','ReceiverViewController@documents_to_received')->name('receiver/documents/received');

		Route::post('receiver/document/received/{id}','ReceiveRequestedDocumentController@receive_validate');

		Route::get('receiver/approved/document/received/{request_no}/{count}','ReceiveRequestedDocumentController@approved_received');

		Route::get('received/delete/document/received/{request_no}/{count}','ReceiveRequestedDocumentController@reject_received');

	// end documents

});

/*Route::middleware(['receiver'])->group(function(){


});*/


Route::middleware(['user'])->group(function(){

	Route::get('user/dashboard','user\UserViewController@dashboard')->name('user/dashboard');

	Route::get('user/documents','user\UserViewController@documents')->name('user/documents');

	Route::get('documents/user/{cat_id}/{filter?}','user\UserViewController@getCategories');

	Route::post('user/request/document','user\UserDocumentRequestController@request_document')->name('user/request/document');

	Route::get('user/document/downloads/{user_id}/{doc_id}','user\UserDocumentRequestController@user_document_download');

	Route::get('user/notification/{user_id}','user\UserViewController@update_Notification');



});

Route::get('sign/out','WebController@sign_out')->name('auth/logout');