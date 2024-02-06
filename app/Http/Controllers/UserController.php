<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::get();
        return view('Users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::get();
        return view('addUser', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages= $this->messages();

        $data = $request->validate([
            'fullname'=>'required|string',
            'Username'=>'required|string',
            'email'=>'required|string',
            'password'=>'required|string',
        ], $messages);

        $data['active'] = isset($request->active);
        User::create($data);
        return 'User has been added successfully';
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::get();
        return view('editUser', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $messages= $this->messages();

        $data = $request->validate([
            'fullname'=>'required|string',
            'Username'=>'required|string',
            'email'=>'required|string',
            'password'=>'required|string',
        ], $messages);

        $data['active'] = isset($request->active);

        User::where('id', $id)->update($data);
        return 'User Updated Successfully';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function messages(){
        return [
            'fullname.required'=>'fullname is required',
            'Username.required'=>'Username is required',
            'email.required'=>'Enter a valid mail',
            'password.required'=>'password should be more than 8 character',
        ];
    }
}
