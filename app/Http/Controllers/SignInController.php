<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\SignIn;
use App\Traits\ApiResponser;

Class SignInController extends Controller {

    use ApiResponser;

    private $request;
    
    public function __construct(Request $request){
    $this->request = $request;
    }

    //GET USERS

    public function getUsers(){

    $users = SignIn::all();
    return response()->json($users, 200);
    }

    //GET USERS

    public function index()
    {
    $users = SignIn::all();
    return $this->successResponse($users);
    }

    //ADD USERS

    public function add(Request $request ){
        $rules = [
        'username' => 'required|max:20',
        'password' => 'required|max:20',
        'gender' => 'required|in:Male,Female',
        ];
        $this->validate($request,$rules);
        $user = SignIn::create($request->all());
        return $this->successResponse($user, Response::HTTP_CREATED);
    }

    //SHOW ID INFORMATION

    public function show($uid)
    {
        $user = SignIn::findOrFail($uid);
        return $this->successResponse($user);
    }

    //UPDATE USERS

    public function update(Request $request,$uid)
    {
    $rules = [
        'username' => 'required|max:20',
        'password' => 'required|max:20',
        'gender' => 'required|in:Male,Female',
    ];
    $this->validate($request, $rules);
    $user = SignIn::findOrFail($uid);

    $user->fill($request->all());
    // if no changes happen
    if ($user->isClean()) {
    return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
    }
    $user->save();
    return $this->successResponse($user);
    }

    //DELETE USERS

    public function delete($uid)
    {
    $user = SignIn::findOrFail($uid);
    $user->delete();
    return $this->successResponse($user);
    }
}