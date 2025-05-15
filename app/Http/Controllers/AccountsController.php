<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accounts;
class AccountsController extends Controller
{
    

    public function index()
    {
        return view('FormPage');
    }

    public function store(Request $request)
    {
        
        $account = new Accounts();
        $account->Username = $request->input('Username');
        $account->name = $request->input('name');
        $account->email = $request->input('email');
        $account->password = bcrypt($request->input('password'));
        $account->phone = $request->input('phone');
        $account->address = $request->input('address');
        $account->whatsappNumber = $request->input('whatsappNumber');

        
        if ($request->hasFile('profilePicture')) {
            $file = $request->file('profilePicture');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $account->profilePicture = $filename;
        }

        $account->save();

        return redirect()->route('accounts.create')->with('success', 'Account created successfully.');
    }
}
