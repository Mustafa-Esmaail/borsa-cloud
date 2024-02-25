<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Office;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        //
        $users = User::all();
        $offices = Office::get(['id','office_name']);
        return view('user.index', compact('users','offices'));
    }


    public function store(UserStoreRequest $request)
    {
        //
        $user = User::create([

            'name'  => $request->name,
            'email'  => $request->email,
            'country'  => $request->country,
            'office_id'  => $request->office_id,
            'password'  =>  Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'user added successfully');

    }


    public function update(UserUpdateRequest $request, string $id)
    {
        //
        $user=User::find($id);
        $user->update($request->all());

        return redirect()->route('users.index')->with('success', 'user updated successfully');



    }


    public function destroy( $id)
    {
        //
        $user=User::find($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'user deleted successfully');

    }
}
