<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return new UserCollection(User::all());
        // $user =User::all();
        // return response()->json([

        //     'status' =>200,
        //     'message' =>$user
        // ], 200);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, User $user)
    {
        $validator = Validator::make($request->all(),[

            'name' => 'required|string|max:40',
            'email' =>'required|string|unique:users',
            'password' =>'required'

        ]);

        $user = User::create($request->all());

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
       $user =User::find($id); 
       if($user){
        return response()->json([
            'status' => 200,
            'message' =>$user
    
           ], 200);
       }else{

        return response()->json([
            'status' =>503,
            'message' =>'No Record Found!'
        ], 503);
       }
      
       // return new UserCollection($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $user =User::find($id);
        // if($user){
        //     $user  =>$request->patch([


        //     ]);
        //     return response()->json([
        //         'status' =>200,
        //         'message' =>'Edited Successfully'
        //     ], 200);
        // }else{
        //     return response()->json([
        //         'status' =>303,
        //         'message' =>'Unforturnatly, the record does not match'
        //     ], 303);

        // }
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {$validator = Validator::make($request->all(), [
        'name' => 'required|string|max:30',
        'email' => 'required|email|unique:users',
        'password' => 'required'
    ]);
    

    // if ($validator->fails()) {
    //     return response()->json(['errors' => $validator->errors()], 400);
    // }

    $user->update($request->all());
    //return new UserCollection($user);
    return response()->json([
        'status' =>200,
        'message' => 'Updated Successfully',
        'Response' => new UserResource($user)

    ], 200);
    
    // $user = User::find($id);
    // if (!$user) {
    //     return response()->json(['error' => 'User not found'], 404);
    // }else{
    //     $user->update($request->all());
    //     return new UserCollection($user);
//}
    
    
    
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {   

        if($user){

            $user->delete();
            return response()->json([
                'status' => 200,
                'message' =>"Deleted Succesfully"
    
            ]);

        }else{

           

            return response()->json([
                'status' => 400,
                'message' => 'Action cannot be performed as we do not have the reord!'
            ], 400);
        }
        
       
        // return new UserResource($user);
    }
}
