<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('UserComponents.Login.login');
    }

    public function userProfile()
    {
        $user = auth()->user();
        $savedProducts = Bookmark::where('user_id', $user->id)->with('product')->get();

        return view('UserComponents.pages.userProfile', compact('user', 'savedProducts'));
    }


    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $request->validate([
            'loginName' => 'required',
            'password' => 'required',
        ]);

        $loginField = filter_var($request->loginName, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $credentials = [$loginField => $request->loginName, 'password' => $request->password];

        if (Auth::attempt($credentials)) {
            session()->flash('success', ' logged in successfully.');
            return redirect()->route('user.index');
        }

        return back()->withErrors([
            'loginName' => 'The provided credentials do not match our records.',
        ]);
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('user.index')->with('success', 'Logged out successfully.');
    }

    public function register(Request $request)
    {
        $request->validate([
            'registerFirstName' => 'required|string|max:255',
            'registerLastName' => 'required|string|max:255',
            'registerEmail' => 'required|string|email|max:255|unique:users,email',
            'registerUsername' => 'required|string|max:255|unique:users,username', // Ensure username is unique
            'registerPassword' => 'required|string|confirmed',
        ]);
    
        // Check if username already exists
        $existingUsername = User::where('username', $request->registerUsername)->exists();
        // Check if email already exists
        $existingEmail = User::where('email', $request->registerEmail)->exists();
    
        if ($existingUsername) {
            return redirect()->back()->withInput($request->all())->with('error', 'The username is already taken. Please choose a different one.');
        }
    
        if ($existingEmail) {
            return redirect()->back()->withInput($request->all())->with('error', 'The email address is already registered. Please use a different one.');
        }
    
        // If both username and email are unique, create the user
        User::create([
            'firstname' => $request->registerFirstName,
            'lastname' => $request->registerLastName,
            'email' => $request->registerEmail,
            'username' => $request->registerUsername,
            'password' => Hash::make($request->registerPassword),
        ]);
    
        return redirect()->route('user-login-signup')->with('success', 'Registration successful. Please login.');
    }
    






    public function updateUser(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'userId' => 'required|integer',
            'fieldName' => 'required|string',
            'newValue' => 'required|string',
        ]);

        // Find the user by ID
        $user = User::findOrFail($validatedData['userId']);

        // Update the user field based on the field name
        switch ($validatedData['fieldName']) {
            case 'firstname':
                $user->firstname = $validatedData['newValue'];
                break;
            case 'lastname':
                $user->lastname = $validatedData['newValue'];
                break;
            case 'username':
                $user->username = $validatedData['newValue'];
                break;
            case 'email':
                $user->email = $validatedData['newValue'];
                break;
                // Add cases for other fields if needed
        }

        // Save the updated user
        $user->save();

        // Return a response
        return response()->json(['message' => 'User details updated successfully'], 200);
    }


    public function updateImage(Request $request)
    {
        // Check if a user is authenticated
        if (auth()->check()) {
            if ($request->hasFile('image')) {
                // Define the directory where the image will be stored
                $directory = public_path('uploads/users');

                // Create the directory if it doesn't exist
                if (!file_exists($directory)) {
                    mkdir($directory, 0755, true);
                }

                // Store the uploaded image in the "users" folder
                $image = $request->file('image');
                $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move($directory, $imageName);

                // Save the image path to the user model
                $user = auth()->user();

                // Delete the old image if it exists
                if ($user->profile_picture) {
                    $oldImagePath = $directory . '/' . $user->profile_picture;
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                // Update the user's profile picture
                $user = User::findOrFail($user->id);
                $user->profile_picture = $imageName;
                $user->save();

                return response()->json(['success' => true, 'message' => 'Image uploaded successfully']);
            }

            return response()->json(['success' => false, 'message' => 'No image uploaded']);
        } else {
            return response()->json(['success' => false, 'message' => 'User not authenticated']);
        }
    }





    public function index()
    {
        return route('user.index');
    }
}
