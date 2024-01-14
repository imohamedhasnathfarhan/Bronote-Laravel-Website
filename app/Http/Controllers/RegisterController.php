<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Auth;
use Hash;

class RegisterController extends Controller
{
    //

    public function create() {
        return view('contact.create');
    }

    public function store(Request $request)
    {
       $input = $request->all();

       User::create([
        'name' => $input['name'],
        'email' => $input['email'],
        'password' => Hash::make($input['password'])
      ]);
       return view('contact.thanks');
    }


}
