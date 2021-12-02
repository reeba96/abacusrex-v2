<?php

namespace Modules\Access\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class UserLogsController extends Controller
{
    public function index(Request $request) {

        Paginator::useBootstrap();

        $locale = app()->getLocale();
        $data = $request->all();
        // $query = ActionLog::query()->orderBy('created_at','desc');

        $activities[''] = '-';
        // $activities = array_merge($activities, ActionLog::groupBy('log_name')->pluck('log_name','log_name')->toArray() );

        $date_filter = $request->input('date_filter', '');
        $activity_filter = $request->input('activity_filter', '');
        $description_filter = $request->input('description_filter', '');

        if ($date_filter){
           // $query = $query->where('created_at', 'like', '%'.$date_filter.'%');
        }
        if ($activity_filter){
           // $query = $query->where('log_name', $activity_filter);
        }
        if ($description_filter) {
           // $query = $query->where('description', 'like', '%'.$description_filter.'%');
        }

        // $logs = $query->paginate(10);
        $logs = 0;

        return view('access::user-logs.index', compact('logs', 'locale', 'data', 'activities', 'date_filter', 'activity_filter', 'description_filter'));
    }
}
