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

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'admin']], function() {

    Route::get('/admin', 'AdminController@index');

    Route::group(['prefix' => 'admin'], function() {

      Route::get('logout', [
        'uses' => 'AuthController@destroy',
        'as' => 'admin.logout'
      ]);
       
      Route::get('dashboard', 'AdminController@dashboard')->name('admin.dashboard');
    
      Route::get('pages', [
          'as' => 'pages',
          'uses' => 'PageController@index'
      ]);
      Route::post('page/store', [
          'as' => 'page.store',
          'uses' => 'PageController@store'
      ]);

      Route::post('page/edit', [
          'as' => 'page.edit',
          'uses' => 'PageController@edit'
      ]);

      Route::put('page/update/{id}', [
          'as' => 'page.update',
          'uses' => 'PageController@update'
      ]);
      Route::post('page/order',[
          'as' => 'page.ordering',
          'uses' => 'PageController@pageOrder'
      ]);
      Route::post('page/online',[
          'as' => 'page.online',
          'uses' => 'PageController@onlineToggle'
      ]);
      Route::post('page/delete', [
          'as' => 'page.delete',
          'uses' => 'PageController@destroy'
      ]);

      Route::post('article/edit', [
          'as' => 'article.edit',
          'uses' => 'ArticleController@edit'
      ]);

      Route::post('article/store', [
          'as' => 'article.store',
          'uses' => 'ArticleController@store'
      ]);
      Route::put('article/update/{id}', [
          'as' => 'article.update',
          'uses' => 'ArticleController@update'
      ]);
      Route::post('article/file-update', [
          'as' => 'article.file.update',
          'uses' => 'ArticleController@fileUpdate'
      ]);
      Route::post('article/order', [
          'as' => 'article.ordering',
          'uses' => 'ArticleController@articleOrder'
      ]);
      Route::post('article/publish', [
          'as' => 'article.publish',
          'uses' => 'ArticleController@publishToggle'
      ]);
      Route::post('article/delete', [
          'as' => 'article.delete',
          'uses' => 'ArticleController@destroy'
      ]);

      Route::post('article/link', [
        'as' => 'article.link',
        'uses' => 'ArticleController@link'
      ]);

      Route::post('article/unlink', [
        'as' => 'article.unlink',
        'uses' => 'ArticleController@unlink'
      ]);

      Route::get('posts', [
          'as' => 'posts',
          'uses' => 'ViewController@posts'
      ]);
      Route::get('media', [
          'as' => 'media',
          'uses' => 'ViewController@media'
      ]);
      Route::get('users', [
          'as' => 'users',
          'uses' => 'ViewController@users'
      ]);
      Route::post('user/modify', [
          'as' => 'user.modify',
          'uses' => 'UserController@update'
      ]);
      Route::post('user/delete',[
          'as' => 'user.delete',
          'uses' => 'UserController@destroy'
      ]);
      Route::post('users/add', [
          'as' => 'user.add',
          'uses' => 'UserController@store'
      ]);
      Route::get('profile', [
          'as' => 'profile',
          'uses' => 'ViewController@profile'
      ]);
      Route::post('profile/pass-change', [
          'as' => 'pass.change',
          'uses' => 'AuthController@passChange'
      ]);
      Route::post('profile/user-change', [
          'as' => 'username.change',
          'uses' => 'AuthController@usernameChange'
      ]);

      Route::get('get-data', [
          'as' => 'get.data',
          'uses' => 'DataController@getJSONtree'
      ]);

      Route::post('refresh_pages_list', [
        'as' => 'article.refresh_pages_list',
        'uses' => 'ArticleController@refresh_pages_list'
      ]);
      
      Route::post('file-upload', [
          'as' => 'file.upload',
          'uses' => 'ImageController@mediaUpload'
      ]);

      Route::post('image/get', [
          'as' => 'get-article-images',
          'uses' => 'ImageController@getArticleMedia'
      ]);
      Route::post('image/delete',[
          'as' => 'delete-article-image',
          'uses' => 'ImageController@deleteArticleMedia'
      ]);
      Route::post('image/sort',[
          'as' => 'image.sort',
          'uses' => 'ImageController@sortMedia'
      ]);

      Route::post('get-media-property', [
        'as' => 'get.media.for.edit',
        'uses' => 'MediaController@getMediaForEdit'
      ]);

      Route::post('new-image', [
        'as' => 'get.new.image',
        'uses' => 'MediaController@getNewImage'
      ]);

      Route::get('slides', [
        'as' => 'sliders',
        'uses' => 'ViewController@sliders'
      ]);
      Route::get('sliders/get', [
        'as' => 'get.slides',
        'uses' => 'SlideShowImageController@getSlides'
      ]);
      Route::get('slide-image/new' , [
        'as' => 'new.slider.image',
        'uses' => 'SlideShowImageController@newSlide'
      ]);
      Route::post('slide-image/edit', [
        'as' => 'slide.image.edit',
        'uses' => 'SlideShowImageController@editSlideImageProperty'
      ]);
      Route::post('slide-image/del' , [
        'as' => 'delete.slider.image',
        'uses' => 'SlideShowImageController@deleteSlide'
      ]);
      Route::post('slide-image/item', [
        'as' => 'get.slide.item',
        'uses' => 'SlideShowItemController@getSlideItems'
      ]);
      Route::post('slide-image/delete', [
        'as' => 'delete.slide.image',
        'uses' => 'SlideShowImageController@deleteSlideImage'
      ]);
      
      Route::post('slider/sort', [
        'as' => 'slider.sort',
        'uses' => 'SlideShowImageController@sliderSort'
      ]);
      Route::get('refresh', [
        'as' => 'refresh.slide.list',
        'uses' => 'SlideShowImageController@refreshSlideImageList'
      ]);
      Route::post('slide-image/options' , [
        'as' => 'get.slide.options',
        'uses' => 'ViewController@getSlideOptions'
      ]);
      Route::post('item/delete' , [
        'as' => 'delete.image.item',
        'uses' => 'SlideShowItemController@deleteImageItem'
      ]);
      Route::post('item/new', [
        'as' => 'new.image.item',
        'uses' => 'SlideShowItemController@createItem'
      ]);
      Route::post('item/properties', [
        'as' => 'get.item.properties',
        'uses' => 'ViewController@getItemProperties'
      ]);
      Route::post('item/publish', [
        'as' => 'slide.image.item.publish',
        'uses' => 'SlideShowItemController@publish'
      ]);
      Route::post('image/publish', [
        'as' => 'slide.image.publish',
        'uses' => 'SlideShowImageController@publish'
      ]);
      Route::post('slide-image/upload-form', [
        'as' => 'slider.image.upload.form',
        'uses' => 'SlideShowImageController@imageUploadFromModal'
      ]);
      Route::post('item/editable', [
        'as' => 'slide.item.editable',
        'uses' => 'SlideShowItemController@editableSlideItem'
      ]);
      Route::post('slide-item/edit', [
        'as' => 'slide.item.edit',
        'uses' => 'SlideShowItemController@editSlideItem'
      ]);
      Route::post('item/add-image', [
        'as' => 'add.item.image',
        'uses' => 'SlideShowItemController@addImage'
      ]);
      Route::post('slider/preview', [
        'as' => 'slider.preview',
        'uses' => 'SlideShowImageController@showPreview'
      ]);

      Route::get('refreshJS', [
        'as' => 'refresh.JS',
        'uses' => 'ViewController@refreshJS'
      ]);
      Route::get('settings/settings', [
          'as' => 'settings',
          'uses' => 'SettingsController@index'
      ]);
      Route::get('settings/settings/edit/{setting}', [
        'as' => 'edit.setting',
        'uses' => 'SettingsController@edit'
      ]);

      // Laravel-mail routes

      Route::get('/', 'MailablesController@toMailablesList');

      // Templates routes
      Route::group(['prefix' => 'settings/templates'], function() {
        Route::get('settings/templates', 'TemplatesController@index')->name('templates');
        Route::get('/', 'TemplatesController@index')->name('templateList');
        Route::get('new', 'TemplatesController@select')->name('selectNewTemplate');
        Route::get('new/{type}/{name}/{skeleton}', 'TemplatesController@new')->name('newTemplate');
        Route::get('edit/{templatename}', 'TemplatesController@view')->name('viewTemplate');
        Route::post('new', 'TemplatesController@create')->name('createNewTemplate');
        Route::post('delete', 'TemplatesController@delete')->name('deleteTemplate');
        Route::post('update', 'TemplatesController@update')->name('updateTemplate');
        Route::post('preview', 'TemplatesController@previewTemplateMarkdownView')->name('previewTemplateMarkdownView');
      });
           
      // Mailables routes
      Route::group(['prefix' => 'settings/mailables'], function() {
        Route::get('settings/mailables', 'MailablesController@index')->name('mailables');
        Route::get('/', 'MailablesController@index')->name('mailableList');
        Route::get('view/{name}', 'MailablesController@viewMailable')->name('viewMailable');
        Route::get('edit/template/{name}', 'MailablesController@editMailable')->name('editMailable');
        Route::get('preview/template/previewerror', 'MailablesController@templatePreviewError')->name('templatePreviewError');
        Route::get('preview/{name}', 'MailablesController@previewMailable')->name('previewMailable');
        Route::post('parse/template', 'MailablesController@parseTemplate')->name('parseTemplate');
        Route::post('preview/template', 'MailablesController@previewMarkdownView')->name('previewMarkdownView');
        Route::post('new', 'MailablesController@generateMailable')->name('generateMailable');
        Route::post('delete', 'MailablesController@delete')->name('deleteMailable');
        Route::post('send-test', 'MailablesController@sendTest')->name('sendTestMail');
      });

      Route::post('settings/submit', [
          'as' => 'submit.settings',
          'uses' => 'SettingsController@submitForm'
      ]);
      Route::get('settings/data', [
          'as' => 'get.setting.data',
          'uses' => 'SettingsController@getData'
      ]);
      Route::post('settings/update', [
          'as' => 'update.settings',
          'uses' => 'SettingsController@update'
      ]);
      Route::post('get-selected-settings', [
          'as' => 'get.selected.settings',
          'uses' => 'SettingsController@getSelectedSetting'
      ]);
      Route::post('add-settings', [
          'as' => 'add.settings',
          'uses' => 'SettingsController@store'
      ]);
      Route::post('delete-settings', [
          'as' => 'delete.settings',
          'uses' => 'SettingsController@delete'
      ]);

      Route::get('modules', [
          'as' => 'modules',
          'uses' => 'ModulesController@index'
      ]);

      Route::get('/install-modules/{module_name}', [
          'as' => 'module.install',
          'uses' => 'ModulesController@doInstall'
      ]);

      Route::get('/uninstall-modules/{module_name}', [
          'as' => 'module.uninstall',
          'uses' => 'ModulesController@doUninstall'
      ]);

      Route::get('get-module-information/{module}', [
          'as' => 'get.module.information',
          'uses' => 'ModulesController@getInformation'
      ]);

      Route::resource('qrcodes', 'QrCodeGensController', ['as' => 'admin']);
        

      Route::group(['prefix' => 'settings/language_lines'], function () {

          Route::get('/', 'LanguageLinesController@index')->name('language_lines.language_lines.index');

          Route::get('/filter', 'LanguageLinesController@index')->name('language_lines.language_lines.filter');

          Route::post('/filter', 'LanguageLinesController@index')->name('language_lines.language_lines.addfilter');

          Route::get('/create','LanguageLinesController@create')->name('language_lines.language_lines.create');

          Route::get('/show/{languageLines}','LanguageLinesController@show')->name('language_lines.language_lines.show');

          Route::get('/{languageLines}/edit','LanguageLinesController@edit')->name('language_lines.language_lines.edit');

          Route::post('/', 'LanguageLinesController@store')->name('language_lines.language_lines.store');

          Route::put('language_lines/{languageLines}', 'LanguageLinesController@update')->name('language_lines.language_lines.update');

          Route::delete('/language_lines/{languageLines}','LanguageLinesController@destroy')->name('language_lines.language_lines.destroy');
      }); 

    });
    
});
