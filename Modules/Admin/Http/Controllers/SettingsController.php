<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Routing\Controller;

use Illuminate\Http\Request;
use Modules\Admin\Entities\Settings;
use Yajra\DataTables\DataTables;
use Validator;

class SettingsController extends Controller
{
    public function submitForm(Request $request) {
        dd($request);
    }

    public function getData() {
        $settings = Settings::all();

        return Datatables::of($settings)
                ->rawColumns(['action', 'delete'])
            ->addColumn('action', function ($setting) {
                return '<a data-id="'.$setting->id.'" data-toggle="modal" data-target="#edit_modal" class="btn btn-xs btn-primary">'
                        . '<i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })
            ->addColumn('delete', function ($setting) {
                return '<a data-id="'.$setting->id.'" data-toggle="modal" data-target="#delete_modal" class="btn btn-xs btn-danger">'
                        . '<i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
    }

    public function index() {
        $settings = Settings::all();
        return view('admin::admin.menu.web-settings', compact('settings'));
    }

    public function store(Request $request) {
        if ($request['is_online'] == 'on') {
            $online = true;
        } else {
            $online = false;
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'content' => 'required',
        ]);

        if ($validator->fails()) {
            $message_array = [];
            foreach ($validator->messages()->getMessages() as $field_name => $messages)
            {
                $message_array[$field_name] = $messages;
            }
            return response()->json(['status' => 'error', 'messages' => $message_array ]);
        }

        Settings::create([
            'name' => $request['name'],
            'content' => $request['content'],
            'enabled' => $online,
            'type' => $request['type']
        ]);

        return redirect()->route('settings')->with('success_message', trans("translate.setting_was_successfully_added"));
    }

    public function edit($id)
    {
        try {
            $setting = Settings::findOrFail($id);

            return view('admin::admin.edit_setting', compact('setting'));

        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans("translate.unexpected_error")]);
        }

    }

    public function update(Request $request) {

        $setting = Settings::findOrFail($request['id']);

        $setting->name = $request['name'];
        $setting->content = $request['content'];
        $setting->type = $request['type'];
        if ($request['is_online'] != null) {
            $setting->enabled = true;
        } else {
            $setting->enabled = false;
        }

        $setting->save();

        return redirect()->route('settings')->with('success_message', trans("translate.setting_was_successfully_updated"));
    }

    public function delete(Request $request) {
        try {
            $setting = Settings::findOrFail($request['id']);
            $setting->delete();

            return redirect()->route('settings')->with('success_message', trans("translate.setting_was_successfully_deleted"));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans("translate.unexpected_error")]);
        }
    }

    public function getSelectedSetting(Request $request) {
        $setting = Settings::findOrFail($request['id']);

        return response()->json(['name' => $setting->name, 'content' => $setting->content,'type' => $setting->type, 'is_online' => $setting->on]);
    }
}
