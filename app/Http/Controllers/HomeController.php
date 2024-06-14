<?php

namespace App\Http\Controllers;

use App\Models\CourseRegistration;
use App\Models\CourseRegistrationItem;
use App\Models\Employed;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Contracts\Role;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $userRoles = $user->getRoleNames();

        if ($userRoles->contains('Administrator')) {
            $orders = CourseRegistration::where('status', 0)
            ->count();
            $totalPrice = CourseRegistrationItem::whereHas('courseRegistration', function ($query) {
                $query->where('status', 0);
            })->sum('price');
            $employeds = Employed::count();
            $orders_unpaid = '';
            $corporate = User::count() - 1 ;
        } else {
            $orders = CourseRegistration::where('user_id', $user->id)->where('status', '!=', 0)->count();
            $employeds = Employed::where('user_id', $user->id)->count();
            $totalPrice = '';
            $orders_unpaid = CourseRegistration::where('user_id', $user->id)->whereNotIn('status', [1, 3])->count();
            $corporate = '';
        }
        return view('home', compact('orders', 'employeds', 'orders_unpaid', 'totalPrice', 'corporate'));
    }

}
