<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DateTime;
use DateTimeImmutable;
use DateTimeZone;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class IndexController extends Controller
{
    // public function index()
    // {

    //     // date_default_timezone_set('Europe/London');

    //     // $datetime = new DateTime('2022-12-26 14:56:23');
    //     // echo $datetime->format('Y-m-d H:i:sA') . "\n";
    //     // $la_time = new DateTimeZone('America/New_York');
    //     // $datetime->setTimezone($la_time);
    //     // echo $datetime->format('Y-m-d H:i:sA');



    //     // $date = new DateTimeImmutable(null, new DateTimeZone('America/New_York'));
    //     // $tz = $date->getTimezone();
    //     // echo $tz->getName();




    //     $date = new DateTime('2022-12-08 00:01:43', new DateTimeZone('Asia/Kolkata'));

    //     $date->setTimezone(new DateTimeZone('America/New_York'));

    //     echo $date->format('Y-m-d H:i:sA');



    //     // $utc_date = DateTime::createFromFormat(
    //     //     'Y-m-d H:i:s',
    //     //     // 'Y-m-d G:i',
    //     //     '2022-12-26 12:56:31',
    //     //     new DateTimeZone('UTC')
    //     //     );

    //     //     $nyc_date = $utc_date;
    //     //     $nyc_date->setTimeZone(new DateTimeZone('America/New_York'));

    //     //     echo $nyc_date->format('Y-m-d H:i:s'); // output: 2011-04-26 10:45 PM


    //     // date_default_timezone_set('Asia/Calcutta');
    //     // $datetime = "2022-12-26 12:44:33";
    //     // echo date_default_timezone_get()."<br>"; // Asia/Calcutta
    //     // date_default_timezone_set('UTC');
    //     // echo date_default_timezone_get()."<br>"; //UTC
    //     // echo $utcDateTime = date("Y-m-d H:i:s",strtotime($datetime));
    //     //     // "<br>";
    //     // echo $utcDateTime;




    //     // $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
    //     // $date = new DateTime('2022-12-26 13:42:21', new DateTimeZone('America/New_York'));
    //     // echo $date->format('Y-m-d H:i:sA') . "\n";

    //     // $date->setTimezone(new DateTimeZone('America/New_York'));
    //     // echo $date->format('Y-m-d H:i:s') . "\n";

















    //     // $date = new DateTime('2018-04-11 12:00:00', new DateTimeZone('Europe/London'));
    //     // $date = new DateTime('2018-04-11 12:00:00', new DateTimeZone('Asia/Kolkata'));
    //     // echo $date->format('Y-m-d H:i:s') . "\n";
    //     // $t = time();
    //     // echo ($t . "<br>");
    //     // echo (date("Y-m-d", $t));

    //     // return time("Y-m-d");


    //     // $date = new DateTime('2018-04-11 12:00:00', new DateTimeZone('Europe/London'));
    //     // echo $date->format('Y-m-d H:i:sP') . "\n";
    // }

    public function index()
    {
        if (Auth::check()) {
            //  return redirect()->route('dashboard');
            return view('Administrator.Dashboard.index');
        } else {
            return redirect()->route('login');
        }
        // return view('Administrator.Dashboard.index');
        // $role = Role::create(['name' => 'user']);
        // $permission = Permission::create(['name' => 'view articles']);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users|email|max:255',
            'phone' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $users = new User();
            $users->first_name = $request->first_name;
            $users->last_name = $request->last_name;
            $users->email = $request->email;
            $users->phone = $request->phone;
            $users->password = Hash::make($request->password);
            if ($users->save()) {
                return 'save';
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
            // return view('Administrator.Dashboard.index');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function createLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        } else {
            return view('Administrator.login');
        }
    }

    public function logout()
    {
        Session::flash();
        return redirect()->route('login')->with('success', 'Successfully Logout');
    }

    public function createRole()
    {
        return view('Administrator.Role.create');
    }

    public function makeRole(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        try {
            Role::create([
                'name' => $request->name,
            ]);
            return redirect()->back()->with('success', 'success');
        } catch (\Throwable $th) {
            throw $th;
        }
        // return $request->all();
        // $role = Role::create(['name' => 'user']);
    }

    public function createUser(){
        return view();
    }
}
