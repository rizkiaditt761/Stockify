<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Activity;
use App\Models\User;

use App\Services\Activity\ActivityService;

class ActivityController extends Controller
{

    protected $activityService;

    public function __construct(
        ActivityService $activityService
    )
    {
        $this->activityService = $activityService;
    }

    public function index(Request $request)
    {

        /*
        |--------------------------------------------------------------------------
        | Filter
        |--------------------------------------------------------------------------
        */

        $filters = [

            'user_id'    => auth()->id(),

            'module'     => $request->module,

            'start_date' => $request->start_date,

            'end_date'   => $request->end_date,

            'search'     => $request->search,

        ];


        /*
        |--------------------------------------------------------------------------
        | Activity List
        |--------------------------------------------------------------------------
        */

        $activities = $this->activityService
            ->getActivities($filters);


        /*
        |--------------------------------------------------------------------------
        | Statistics
        |--------------------------------------------------------------------------
        */

        $totalActivities = Activity::where(
            'user_id',
            auth()->id()
        )->count();


        $todayActivities = Activity::where(
            'user_id',
            auth()->id()
        )
        ->whereDate(
            'created_at',
            today()
        )
        ->count();


        $mostUsedModule = Activity::where(
            'user_id',
            auth()->id()
        )
        ->selectRaw('module, COUNT(*) as total')
        ->groupBy('module')
        ->orderByDesc('total')
        ->first();


        /*
        |--------------------------------------------------------------------------
        | View
        |--------------------------------------------------------------------------
        */

        return view(
            'pages.activity.index',
            [

                'activities' => $activities,

                'users' => User::orderBy('name')->get(),

                'totalActivities' => $totalActivities,

                'todayActivities' => $todayActivities,

                'mostUsedModule' => $mostUsedModule,

            ]
        );

    }

}