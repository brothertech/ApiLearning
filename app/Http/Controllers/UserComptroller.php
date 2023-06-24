<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserComptroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getUsers($id=null)
    {
        if (empty($id)) {
            $users = User::get();
        
            return response()->json([
                'status' => 200,
                'message' => $users
            ], 200);
        } else {
            $user = User::find($id);
            
            if ($user) {
                return response()->json([
                    'status' => 200,
                    'message' => $user
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Record not found!'
                ], 404);
            }
        }
        
        
        
        
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
    public function add_single_user(Request $request)
    {
        //this is another method of processing data into the database using post method
        if($request->isMethod('post')){

            $userData = $request->input();
            // echo "<pre>"; print_r($userData); die;
            $user = new User();
            $user->name=$userData['name'];
            $user->email=$userData['email'];
            $user->password = bcrypt($userData['password']);
            $user->save();
            return response()->json([
                'status' =>200,
                'message' => 'Registration Successful'
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function getUser( string $id)
    {
        //the example in getUsers shows how to combine both getAll and getId. getId is similar to find Id
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function add_multiples_users(Request $request)
    {
        if($request->isMethod('post')){

            $userData =$request->input();

            foreach($userData['users'] as $key =>$value){

                $users = new User();
                $users->name = $value['name'];
                $users ->email = $value['email'];
                $users ->password =bcrypt($value ['password']);
                $users->save();
                return response()->json([
                    'status' =>200,
                    'message' =>'Users Added succesfully!'


                ], 200);

            }

        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
