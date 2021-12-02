<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Modules\Admin\Entities\SlideShowImage;
use Modules\Admin\Entities\SlideShowItem;
use Validator;
use App;

class SlideShowImageController extends Controller
{

    // Get the slider image list view
    public function getSlides() {
        return view('admin::admin.layouts.slider-image-list');
    }

    // Create new slide image instance in the DB, and add it to the view
    public function newSlide() {
        SlideShowImage::create();
        return view('admin::admin.layouts.slider-image-list');
    }

    public function refreshSlideImageList() {
      return view('admin::admin.layouts.slider-image-list');
    }

    public function editSlideImageProperty(Request $request) {

        $validator = Validator::make($request->all(), [
            'masterspeed' => 'integer|nullable',
            'delay' => 'integer|nullable'
        ]);

        if ($validator->fails()) {
            $message_array = [];
            foreach ($validator->messages()->getMessages() as $field_name => $messages)
             {
                foreach($messages as $message) {
                    array_push($message_array, $message);
                }
             }
            return response()->json(['status'=>'error', 'messages'=>$message_array], 200);
        }

        $slide_image = SlideShowImage::findOrFail($request['id']);
        $slide_image->title = $request['title'];
        $slide_image->date_on = $request["date_on"];
        $slide_image->date_off = $request["date_off"];
        $slide_image->transition = $request['transition'];
        $slide_image->slotamount = $request['slotamount'];
        $slide_image->masterspeed = $request['masterspeed'];
        $slide_image->delay = $request['delay'];
        $slide_image->save();

        return response()->json(['status'=> 'success', 'message' => 'Slide image edited successfully!'], 200);
    }


    // Delete the image inside the slideshow item
    public function deleteSlideImage(Request $request) {
      $slide_image = SlideShowImage::findOrFail($request['id']);
      $filename = 'filename_' . $request['lang'];
      $slide_image->$filename = null;
      $slide_image->save();

      Storage::delete('/public/rev_slider/images/' . $request['file']);

      return response()->json( ['code' => $request['lang'] ],200);
    }

    // Delete the selected slideshow (image) instance form DB
    public function deleteSlide(Request $request) {
        $id = $request['slider_id'];
        $items = SlideShowItem::where('slide_show_image_id', $id)->get();
        // If the image has items delete items too
        if (count($items) >= 1) {
            foreach ($items as $item) {
              $item->delete();
            }
        }
        $delete = SlideShowImage::where('id', $id)->delete();
        return response()->json(['message' => 'success']);
    }

    // image upload for slider by languages
    public function imageUploadFromModal(Request $request) {
      $slide_image_id = $request['id'];
      // user can upload different images for different languages
      // in $lang we send the selected language (filename_hu, filename_en, ... )
      $lang = $request['lang'];

      if(substr($request->file('slide_image_form')->getMimeType(), 0, 5) != 'image') {
          return response()->json(['status'=>'error', 'msg'=>'The uploaded file is not an image'], 200);
      }

      $validator = Validator::make($request->all(), [
          'slide_image_form' => 'max:'.(10*1024),
      ]);

      if ($validator->fails()) {
          return response()->json(['status'=>'error', 'msg'=>'Too big file size. Max 10 MB'], 200);
      }

      // get the language code only
      $code = explode('_', $lang);
      $code = end($code);
      // find the slideshow image in DB
      $slide_image = SlideShowImage::findOrFail($slide_image_id);
      $btn = 1;
      if ($slide_image->$lang != null) {
        $current = $slide_image->$lang;
        $f = 'public/rev_slider/images/' . $current;
        Storage::delete($f);
        $btn = 0;
      }
      $orig_name = $request->file('slide_image_form')->getClientOriginalName();

      // [0] => name
      // [1] => extension
      $name = explode('.', $orig_name);
      $filename = $name[0] . '-' . $slide_image_id . '.' . end($name);
      $slide_image->$lang = $filename;
      $slide_image->save();
      // save the image in the rev_slider/images folder with the name of image
      //  attached with slide_image_id
      $dir = '/public/rev_slider/images';
      $request->file('slide_image_form')->storeAs($dir, $filename);
      $src = '/storage/rev_slider/images/' . $filename;

      return response()->json(['filename' => $filename, 'lang' => $lang, 'src' => $src, 'btn' => $btn, 'code' => $code], 200);
    }

    // publishing the image
    public function publish(Request $request) {
      $slide_img = SlideShowImage::findOrFail($request['id']);
      if ($request['status'] == 1) {
          $slide_img->online = 0;
          $status = 0;
      } else {
          $slide_img->online = 1;
          $status = 1;
      }
      $slide_img->save();
      return response()->json(['message' => "Slide image's status changed successfully!", 'status' => $status]);
    }

    // Sort the slider images
    public function sliderSort(Request $request) {
      $array = $request['ids'];
      foreach ($array as $key => $id) {
        // In the loop, the slide image finds by $value (id),
        // and its rank will be the $key + 1
          $slide = SlideShowImage::findOrFail($id);
          if ($slide) {
              $slide->order_no = $key + 1;
              $slide->save();
          }
      }
      return response()->json(['sort' => 'The order of slide images changed successfully!'], 200);
    }

    // include slide preview view
    public function showPreview(Request $request) {
      $locale = App::getLocale();
      $image = SlideShowImage::findOrFail($request['id']);
      if ($image['filename_'.$locale] === NULL) {
          return response()->json(['status'=>'error', 'msg' => 'Image not found'], 200);
      }
      $items = $image->items;
      return view('admin::admin.includes.slide-preview', compact(['image', 'items']));
    }
}
