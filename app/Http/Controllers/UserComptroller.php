<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

                
                        // if (!filter_var($userData['email'], FILTER_VALIDATE_EMAIL)) {
                        //     $error_message ='Please enter valid email address';
                        // // return response()->json([
                        // //     'message' =>$error_message
                        // // ], 422);

                        // }

                        //     $userCount =User::where('email', $userData['email'])->count();
                        //     if($userCount >0){

                        //         $error_message = "Email Already!";
                        //         // return response()->json([

                        //         //     'status' => false,
                        //         //     'message' => $error_message
                        //         // ], 422);
                        //     }

                        //     if(empty($userData['name']) || empty($userData['email']) || empty($userData['password'])){

                        //         $error_message = "Enter Complete Details";
                        //         // return response()->json([
                        //         //     'status' =>false,
                        //         //     'message' => $error_message
                        //         // ], 403);
                        //     }
                            
                        //     //instead of having different return responses, we can have one, i will comment on those one to showcase the example
                        //     if(isset($error_message) &&!empty($error_message)){

                        //         return response()->json([
                        //             "status" =>false,
                        //             "message" => $error_message
                        //         ], 403);
                        //     }

                        //===========Adding advanced validation

                        $rules =[
                            'name' => 'required|string|max:23',
                            'email' => 'required|email|unique:users',
                            'password'=> 'required'


                        ];

                        //How to add custom validation message
                        $customMessages =[

                            'name.required' => 'Name field cannot be left empty',
                            'name.string' =>'Name must contain characters only',
                            'name.max' =>'The maximum allowed characters cannot be more than 23',
                            'email.required' =>'Email field must be filled',
                            'email.email' => 'Enter correct email format',
                            'email.unique' => 'OOPs! we already have this email in our database',
                            'password.required'=> 'Password must be filled in'
                        ];

                        $validator =Validator::make($userData, $rules, $customMessages);

                        if($validator ->fails()){
                            return response()->json([
                                'message'=>$validator->errors()
                            ], 422);
                        }
                    
            $user = new User();
            $user->name=$userData['name'];
            $user->email=$userData['email'];
            $user->password = bcrypt($userData['password']);
            $user->save();
            return response()->json([
                'status' =>201,
                'message' => 'Registration Successful'
            ], 201);
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
            //validation rules for multiples data
            $rules =[

                'users.*.name' =>'required|string|max:23', //users is table name in the database
                'users.*.email' =>'required|email|unique:users',
                'users.*.password' =>'required'
                // 'email' =>'required|email|unique:users',
                // 'password' =>'required'

            ];
            //custom validation messages

            // 'name.required' => 'Name field cannot be left empty',
            //                 'name.string' =>'Name must contain characters only',
            //                 'name.max' =>'The maximum allowed characters cannot be more than 23',
            //                 'email.required' =>'Email field must be filled',
            //                 'email.email' => 'Enter correct email format',
            //                 'email.unique' => 'OOPs! we already have this email in our database',
            //                 'password.required'=> 'Password must be filled in'

            //making strong password, below is the tehnical know how
            /*


             public function rules()
    {
        return [
            'email' => 'required|email:rfc,dns|unique:users,email',
            'username' => 'required|unique:users,username',
            'password' => [
                'required',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
            ],
            'password_confirmation' => 'required|same:password'
        ];
    }
}





            // 'name.required' => 'Name field cannot be left empty',
            //                 'name.string' =>'Name must contain characters only',
            //                 'name.max' =>'The maximum allowed characters cannot be more than 23',
            //                 'email.required' =>'Email field must be filled',
            //                 'email.email' => 'Enter correct email format',
            //                 'email.unique' => 'OOPs! we already have this email in our database',
            //                 'password.required'=> 'Password must be filled in'
            */

            $customMessages =[
                'users.*.name.required' => 'Name field cannot be left empty',
                'users.*.name.string' =>'Name must contain characters only',
                'users.*.name.max' =>'The maximum allowed characters cannot be more than 23',
                'users.*.email.required' =>'Email field must be filled',
                'users.*.email.email' =>'Enter correct email format',
                'users.*.email.unique' =>'OOPs! we already have this email in our database',
                'users.*.password.required' => 'Password must be filled in'

            ];

            $validator =Validator::make($userData, $rules, $customMessages);
            if($validator->fails()){

                return response()->json([
                    'message' =>$validator->messages()

                ], 422);
            }

                        
            //this part commented out is actually working fine but the below is jsut a test of how to use array

            foreach($userData['users'] as $key =>$value){
                  
                $user= new User();
                $user->name = $value['name'];
                $user ->email = $value['email'];
                $user ->password =bcrypt($value ['password']);
                $user->save();
                return response()->json([
                    'status' =>201,
                    'message' =>'Users Added succesfully!'


                ], 201);

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
