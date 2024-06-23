<?php

namespace App\Http\Controllers;

// Import the necessary classes and traits
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\SignIn;
use App\Traits\ApiResponser;

class SignInController extends Controller {

    // Use the ApiResponser trait for standardized responses
    use ApiResponser;

    // Property to hold the Request instance
    private $request;

    // Constructor to inject the Request dependency
    public function __construct(Request $request){
        $this->request = $request;
    }

    // Method to get all users
    public function getUsers(){
        // Retrieve all users from the SignIn model
        $users = SignIn::all();
        // Return the users as a JSON response with status code 200
        return response()->json($users, 200);
    }

    // Method to get all users using ApiResponser trait
    public function index(){
        // Retrieve all users from the SignIn model
        $users = SignIn::all();
        // Return the users using the successResponse method from the ApiResponser trait
        return $this->successResponse($users);
    }

    // Method to add a new user
    public function add(Request $request){
        // Validation rules for the request
        $rules = [
            'username' => 'required|max:20',
            'password' => 'required|max:20',
            'gender' => 'required|in:Male,Female',
        ];
        // Validate the request based on the rules
        $this->validate($request, $rules);
        // Create a new user with the request data
        $user = SignIn::create($request->all());
        // Return the created user with status code 201
        return $this->successResponse($user, Response::HTTP_CREATED);
    }

    // Method to show a user's information by ID
    public function show($uid){
        // Find the user by ID or fail
        $user = SignIn::findOrFail($uid);
        // Return the user information using the successResponse method
        return $this->successResponse($user);
    }

    // Method to update a user's information
    public function update(Request $request, $uid){
        // Validation rules for the request
        $rules = [
            'username' => 'required|max:20',
            'password' => 'required|max:20',
            'gender' => 'required|in:Male,Female',
        ];
        // Validate the request based on the rules
        $this->validate($request, $rules);
        // Find the user by ID or fail
        $user = SignIn::findOrFail($uid);

        // Fill the user model with the request data
        $user->fill($request->all());
        // Check if no changes have been made
        if ($user->isClean()) {
            // Return an error response if no changes were made
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        // Save the updated user information
        $user->save();
        // Return the updated user information using the successResponse method
        return $this->successResponse($user);
    }

    // Method to delete a user by ID
    public function delete($uid){
        // Find the user by ID or fail
        $user = SignIn::findOrFail($uid);
        // Delete the user
        $user->delete();
        // Return the deleted user information using the successResponse method
        return $this->successResponse($user);
    }
}