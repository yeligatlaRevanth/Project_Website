<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Dish;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Message;

class MyController extends Controller
{
    public $my_email;

    //
    function firstfun()
    {
        return "This is my first function";
    }

    function fun_login()
    {
        return view('a1_login');
    }

    function fun_signup()
    {
        return view('a2_signup');
    }

    function fun_contact()
    {
        return view('a3_contact');
    }
    function fun_home()
    {
        $query = 'SELECT id,dish_email,dish_name,dish_image,dish_cuisine,dish_time,dish_ingredients FROM user_dishes';
        $dishes_all = DB::select($query);

        error_log($query);
        return view('/a4_home')->with('dishes_all', $dishes_all);
    }

    function fun_userprofile()
    {
        $query = 'SELECT dish_name,dish_image,dish_cuisine,dish_time,dish_ingredients FROM user_dishes WHERE dish_email = "' . auth()->user()->email . '"';
        $dishes_all = DB::select($query);

        error_log($query);
        return view('/a5_userprofile')->with('dishes_all', $dishes_all);
    }


    function post_login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('home'))->with("success", "Login Successfull");
        }
        return redirect(route('login'))->with("error", "Login credentials not matching");
    }

    function post_signup(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password1' => 'required',
            'password2' => 'required'
        ]);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $my_email = $request->email;
        $data['password'] = $request->password1;
        $pwd2 = $request->password2;

        if ($data['password'] == $pwd2) {
            $user = User::create($data);
            if (!$user) {
                return redirect(route('signup'))->with("error", "Signup Failed");
            }

            return redirect(route('login'))->with("success", "Registration Successfull");
        }
    }

    function add_dish(Request $request)
    {
        $dish = new Dish();
        $dish->dish_email = auth()->user()->email;
        //Image
        if ($request->hasFile('dish_image')) {
            $file = $request->file('dish_image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/dishes', $filename);
            $dish->dish_image  = $filename;
        } else {
            return $request;
            $dish->dish_image = '';
        }
        $dish->dish_name = $request->input('dish_name');
        $dish->dish_cuisine = $request->get('dish_cuisine');
        $dish->dish_ingredients = $request->input('dish_ingredients');
        $dish->dish_dir = $request->input('dish_dir');
        $dish->dish_time = $request->input('dish_time');

        $dish->save();
        $query = 'SELECT id,dish_name,dish_image,dish_cuisine,dish_time,dish_ingredients FROM user_dishes WHERE dish_email = "' . auth()->user()->email . '"';
        $dishes_all = DB::select($query);
        return view('a5_userprofile')->with('dishes_all', $dishes_all);
    }



    function showDishFull($dishId)
    {
        $query = 'SELECT id,dish_email,dish_name,dish_image,dish_cuisine,dish_time,dish_ingredients, dish_dir FROM user_dishes WHERE id = "' . $dishId . '"';
        $maindish = DB::select($query);
        return view('a6_dish')->with('maindish', $maindish);
    }

    function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }

    function showAllRecipes()
    {
        return view('a7_allrecipes');
    }


    public function suggestions(Request $request)
    {
        $searchText = $request->input('searchText');
        // Simulate search suggestions (replace with your actual logic)
        $suggestions = Dish::where('dish_name', 'like', "%{$searchText}%")->limit(5)->get();


        return response()->json($suggestions);
    }

    public function userMessages(Request $request)
    {
        // Get all users except the current user
        
        $users = User::where('id', '!=', auth()->id())->get();
        // Pass the users data to the view
        return view('a8_userMessages')->with('users', $users);
    }
}
