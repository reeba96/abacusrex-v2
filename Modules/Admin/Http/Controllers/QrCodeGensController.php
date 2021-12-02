<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Routing\Controller;

use Illuminate\Http\Request;
use Modules\Admin\Entities\QrCodeGen;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Intervention\Image\Facades\Image;

class QrCodeGensController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $qr_codes = QRCodeGen::all();
        
        return view('admin::admin.menu.qrcodes', compact('qr_codes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {
            $this->validate($request, [
                'url' => 'required|unique:qr_code_gens,url|url'
            ]);
            
            $qr_code_path = 'images/qr_codes';
            
            $qr_code = QrCodeGen::create([
               'url' => $request['url']
            ]);
            
            if (!file_exists(public_path($qr_code_path))) {
                mkdir(public_path($qr_code_path), 0777, true);
            }
            
            $qr_code_photo_name = $qr_code->id . '.png';
            
            QrCode::format('png')->size(200)->generate($request->url, public_path($qr_code_path) . '/' . $qr_code_photo_name);
            
            $qr_code->update([
                'photo' => $qr_code_photo_name
            ]);

            return ['message' => "OK"];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QrCodeGen $qrcode)
    {
        if ($request->ajax()) {
            $this->validate($request, [
                'url' => 'required|unique:qr_code_gens,url,' . $qrcode->id . '|url'
            ]);
            
            $qr_code_path = 'images/qr_codes';

            if (file_exists($path = public_path($qr_code_path) . '/' . $qrcode->getAttributes()['photo'])) {
                unlink($path);
            }
            
            $qr_code_photo_name = $qrcode->id . '.png';
            
            QrCode::format('png')->size(200)->generate($request->url, public_path($qr_code_path) . '/' . $qr_code_photo_name);
            
            $qrcode->update([
                'url' => $request->url,
                'photo' => $qr_code_photo_name
            ]);
            
            return [
                'message' => "OK",
                "new_url" => $request->url,
                "new_photo" => $qrcode->photo,
                "id" => $qrcode->id
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(QrCodeGen $qrcode)
    {
        $qr_code_path = 'images/qr_codes';

        if (file_exists($path = public_path($qr_code_path) . '/' . $qrcode->getAttributes()['photo'])) {
            unlink($path);
        }
        
        if ($qrcode->page) {
            $qrcode->page()->update([
                'qrcode' => false
            ]);
        }
        
        $qrcode->delete();
        
        return ['message' => 'OK', 'id' => $qrcode->id];
    }
}
