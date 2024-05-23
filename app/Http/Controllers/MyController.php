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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class MyController extends Controller
{
    public $my_email;

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
        $query = 'SELECT id,dish_email,dish_name,dish_image,dish_time,dish_ingredients FROM user_dishes';
        $dishes_all = DB::select($query);

        error_log($query);
        return view('/a4_home')->with('dishes_all', $dishes_all);
    }

    function fun_userprofile()
    {
        // Fetch dishes associated with the user's email
        $query = 'SELECT id, dish_name, dish_image, dish_time, dish_ingredients FROM user_dishes WHERE dish_email = "' . auth()->user()->email . '"';
        $dishes_all = DB::select($query);

        // Calculate the number of posts (dishes) associated with the user's email
        $email = auth()->user()->email;
        $postCount = DB::table('user_dishes')->where('dish_email', $email)->count();

        // Determine the user's level based on the post count
        if ($postCount <= 5) {
            $userLevel = 'Novice';
        } elseif ($postCount > 5 && $postCount <= 10) {
            $userLevel = 'Intermediate';
        } elseif ($postCount > 10 && $postCount <= 20) {
            $userLevel = 'Sous Chef';
        } else {
            $userLevel = 'Pro Chef';
        }

        // Pass both dishes_all and userLevel to the view
        return view('/a5_userprofile', compact('dishes_all', 'userLevel'));
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

    public function post_signup(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password1' => 'required|min:6',
            'password2' => 'required|same:password1'
        ]);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = bcrypt($request->password1);

        $user = User::create($data);
        if (!$user) {
            return redirect(route('signup'))->with('error', 'Signup Failed');
        }

        return redirect(route('login'))->with('success', 'Registration Successful');
    }


    public function add_dish(Request $request)
    {
        // Handle dish submission
        if ($request->has('submit_dish')) {
            try {
                // Validate the request data
                $validatedData = $request->validate([
                    'title' => 'required|string|max:255',
                    'description' => 'nullable|string',
                    'time' => 'required|string|max:255',
                    'dish_yield' => 'required|string|max:255',
                    'ingredients' => 'required|array',
                    'directions' => 'required|array',
                    'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Ensure image is optional
                ]);

                // Convert ingredients array to a string separated by '%_%'
                $ingredientsString = implode('%_%', $validatedData['ingredients']);

                // Convert directions array to a string separated by '%_%'
                $directionsString = implode('%_%', $validatedData['directions']);

                // Create a new dish instance
                $dish = new Dish();

                // Upload the image if provided
                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $extension = $image->getClientOriginalExtension();
                    $imageName = time() . '.' . $extension;
                    $image->move('uploads/dishes', $imageName);
                    $dish->dish_image = $imageName;
                }

                // Assign the rest of the dish attributes
                $dish->dish_name = $validatedData['title'];
                $dish->dish_description = $validatedData['description'];
                $dish->dish_time = $validatedData['time'];
                $dish->dish_yield = $validatedData['dish_yield'];
                $dish->dish_email = Auth::user()->email;
                $dish->dish_ingredients = $ingredientsString;
                $dish->dish_dir = $directionsString;

                // Save the dish to the database
                $dish->save();

                // Redirect the user back to the home page with a success message
                return redirect()->route('home')->with('success', 'Dish added successfully!');
            } catch (\Illuminate\Validation\ValidationException $e) {
                // Log the validation error messages
                Log::error('Validation error: ' . json_encode($e->errors()));

                // Return the error messages to the view
                return redirect()->back()->withErrors($e->errors())->withInput();
            } catch (\Exception $e) {
                // Log the general error message
                Log::error('Error adding dish: ' . $e->getMessage());

                // Return the error message to the view
                return redirect()->back()->with('error', 'There was an error adding your dish. Please try again.');
            }
        }

        // Handle user image upload
        if ($request->has('user_image')) {
            $image = $request->file('user_image');
            $extension = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $extension;
            $image->move('uploads/users', $imageName);

            // Update the user's avatar field in the database
            $user = User::find(auth()->id()); // Assuming you're using Laravel's built-in authentication
            $user->avatar = $imageName;
            $user->save();

            // Redirect back or return a view
            return redirect()->back()->with('success', 'Image uploaded successfully');
        } else {
            // Handle if no file is uploaded
            return redirect()->back()->with('error', 'No file uploaded');
        }
    }


    public function uploadImage(Request $request)
    {
        if ($request->hasFile('ub_img')) {
            $image = $request->file('ub_img');
            $extension = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $extension;
            $image->move('uploads/users', $imageName);

            // Update the user's avatar field in the database
            $user = User::find(auth()->id()); // Assuming you're using Laravel's built-in authentication
            $user->avatar = $imageName;
            $user->save();

            // Redirect back or return a view
            return redirect()->back()->with('success', 'Image uploaded successfully');
        } else {
            // Handle if no file is uploaded
            return redirect()->back()->with('error', 'No file uploaded');
        }
    }
    function showDishFull($dishId)
    {
        $query = 'SELECT id,dish_description,dish_email,dish_name,dish_image,dish_time,dish_ingredients, dish_dir FROM user_dishes WHERE id = "' . $dishId . '"';
        $maindish = DB::select($query);
        return view('a6_dish')->with('maindish', $maindish);
    }

    function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }



    function func_recipes()
    {
        // Fetch latest 5 dishes
        $latest_dishes = DB::table('user_dishes')->orderBy('id', 'desc')->get();

        // Pass the fetched data to the Blade file
        return view('a7_allrecipes')->with('latest_dishes', $latest_dishes);
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

    public function sendEmail(Request $request)
    {
        // Retrieve form data
        $name = $request->input('name');
        $email = $request->input('email');
        $query = $request->input('query');

        // Email details
        $to = 'revanth.yeligatla@gmail.com';
        $subject = 'Query from Contact Form';
        $message = "Name: $name\n";
        $message .= "Email: $email\n";
        $message .= "Query: $query\n";
        $headers = 'From: ' . $email; // Set From address to the provided email

        // Send email
        if (mail($to, $subject, $message, $headers)) {
            return redirect()->back()->with('success', 'Email sent successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to send email. Please try again later.');
        }
    }
}
