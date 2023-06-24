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
            $users = User::paginate();
        
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

            // if(!(empty($userData['name']) || empty($userData['email']) || empty($userData['password']))){
            //     $message ='Please enter valid credential';
            //     return response()->json([

            //         'status' =>false,
            //         'message' =>$message
            //     ], 422);

            // }

            // if (empty($userData['name']) || empty($userData['email']) || empty($userData['password'])) {
            //     $message = 'Please enter valid credentials.';
            //     return response()->json([
            //         'status' => false,
            //         'message' => $message
            //     ], 422);
            // }
            

            //validation of email takes place here

                
                        if (!filter_var($userData['email'], FILTER_VALIDATE_EMAIL)) {
                            $error_message ='Please enter valid email address';
                        // return response()->json([
                        //     'message' =>$error_message
                        // ], 422);

                        }

                            $userCount =User::where('email', $userData['email'])->count();
                            if($userCount >0){

                                $error_message = "Email Already!";
                                // return response()->json([

                                //     'status' => false,
                                //     'message' => $error_message
                                // ], 422);
                            }

                            if(empty($userData['name']) || empty($userData['email']) || empty($userData['password'])){

                                $error_message = "Enter Complete Details";
                                // return response()->json([
                                //     'status' =>false,
                                //     'message' => $error_message
                                // ], 403);
                            }
                            
                            //instead of having different return responses, we can have one, i will comment on those one to showcase the example
                            if(isset($error_message) &&!empty($error_message)){

                                return response()->json([
                                    "status" =>false,
                                    "message" => $error_message
                                ], 403);
                            }

                    
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

            //Validation of APIs

            // if(empty($userData['name']) || empty($userData['email']) || empty($userData['password'])){
            //     $message ='Please enter valid credential';
            //     return response()->json([

            //         'status' =>false,
            //         'message' =>$message
            //     ], 422);

            // }

            // //validation of email takes place here

                
            // if (!filter_var($userData['email'], FILTER_VALIDATE_EMAIL)) {
            //     $message_email = 'Please enter a valid email address.';
            //     return response()->json([
            //         'message' => $message_email
            //     ], 422);
            // }
            //If Email already exist
            $userCount =User::where('email', $userData['email'])->count();
            if($userCount >0){

                $message = "Email already Exist";

                return response()->json([

                    "message" =>$message
                ]);
            }


                        
            //this part commented out is actually working fine but the below is jsut a test of how to use array

            foreach($userData['users'] as $key =>$value){

                $user= new User();
                $user->name = $value['name'];
                $user ->email = $value['email'];
                $user ->password =bcrypt($value ['password']);
                $user->save();
                return response()->json([
                    'status' =>200,
                    'message' =>'Users Added succesfully!'


                ], 200);

            }
            //     //the method below help to generate data up to 200 using array
            // $users = [];

            // for ($i = 1; $i <= 200; $i++) {
            //     $user = [
            //         'name' => 'User' . $i,
            //         'email' => 'user' . $i . '@example.com',
            //         'password' => bcrypt('password' . $i)
            //     ];
            //     $users[] = $user;
            // }
            
            // // Return the generated users as JSON response
            // return response()->json($users);
            

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
