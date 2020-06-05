<?php

namespace App\Http\Controllers\Api;

use App\Topic;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('super_user', 0)->get();

        $result = [
            'message' => 'Successfully retrieved users.',
            'data' => [
                'users' => $users
            ]
        ];

        return response()->json($result, 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $input = $request;

        $user = User::find($id);

        $user->name      = $input['name'];
        $user->email     = $input['email'];
        if (! empty($input['password'])) {
            $user->password  = bcrypt($input['password']);
        }

        $user->save();

        $result = [
            'message' => 'Account updated successfully',
            'data' => [
                'user' => $user
            ]
        ];

        return response()->json($result, 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();

        Topic::where('user_id', $id)->delete();

        return  'User successfully deleted.';
    }
}
