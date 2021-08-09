<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => User::all()
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $register_validation = Validator::make($request->all(),[
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()],
            'password_confirmation' => ['required', 'same:password'],
            'roles' => ['required', Rule::in(['admin', 'kasir', 'gudang'])]
        ]);

        if($register_validation->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $register_validation->errors()->all()
            ], 401);
        }

        $data = $request->all();
        $data['password'] = bcrypt($data['password']);

        try{
            $new_user = User::create($data);
            return response()->json([
                'status' => 'success',
                'data' => $new_user
            ], 201);
        }catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => $e
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if($user == null){
            return response()->json([
                'status' => 'failed',
                'message' => 'Resource not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $user
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user_data = User::find($id);
        if($user_data == null){
            return response()->json([
                'status' => 'failed',
                'message' => 'Resource Not Found'
            ], 404);
        }

        $array_data = $request->all();
        if(array_key_exists('name', $array_data)){
            try {
                $user_data->name = $array_data['name'];
                $user_data->save();
            } catch (Exception $e) {
                return response()->json([
                    'status' => 'failed',
                    'message' => $e
                ], 500);
            }
        }

        if(array_key_exists('password', $array_data)){
            try {
                $user_data->password = bcrypt($array_data['password']);
                $user_data->save();
            } catch (Exception $e) {
                return response()->json([
                    'status' => 'failed',
                    'message' => $e
                ], 500);
            }
        }

        return response()->json([
            'status' => 'failed',
            'message' => 'Request Unknown'
        ], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if($user == null){
            return response()->json([
                'status' => 'failed',
                'message' => 'Resource Not Found'
            ], 404);
        }

        try {
            $user->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'User Has Been Deleted'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => "Internal Server Error"
            ], 500);
        }
    }

}
