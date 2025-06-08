<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accounts;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use App\Mail\NewaccountMail;
use Illuminate\Support\Facades\Mail;

class AccountsController extends Controller
{
    

    public function index()
    {
        return view('FormPage');
    }

    public function store(Request $request)
    {
        // Debugging line to check if the method is called
        try{
            Log::info('Store method called in AccountsController');
            $request->validate([
                'full_name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:accounts,Username',
                'email' => 'required|email|max:255|unique:accounts,email',
                'password' => 'required|string|min:8',
                'phone' => 'nullable|string|max:15',
                'address' => 'nullable|string|max:255',
                'whatsapp_number' => 'nullable|string|max:15',
                'profilePicture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
              $account = new Accounts();
        $account->Username = $request->input('username');
        $account->name = $request->input('full_name');
        $account->email = $request->input('email');
        $account->password = bcrypt($request->input('password'));
        $account->phone = $request->input('phone');
        $account->address = $request->input('address');
        $account->whatsappNumber = $request->input('whatsapp_number');

        
        if ($request->hasFile('profilePicture')) {
            $file = $request->file('profilePicture');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $account->profilePicture = $filename;
        }

        $account->save();
     
       
        $data = [
            'subject' => 'New Account Created',
            'username' => $account->Username,
            'name' => $account->name,
            'email' => $account->email];
       try {
            Mail::to('ahemd.alaa.9.25@gmail.com')->send(new NewaccountMail($data));
            Log::info('Email sent successfully to: ' . $account->email);
        } catch (\Exception $emailException) {
            Log::error('Email sending failed: ' . $emailException->getMessage());
        }        
        return response()->json([
                'redirect' => route('accounts.index'),
                'message' => 'Account created successfully.'
            ]);

        } 
        catch(ValidationException $e) {
            Log::error('Validation error: ' . $e->getMessage());
            
            return response()->json([
                'errors' => $e->validator->errors(),
                'message' => $e->getMessage()
            ], 422);
        }   
        
        catch(\Exception $e){
            Log::error('Error creating account: ' . $e->getMessage());
            
            return response()->json([
                'message' => 'Failed to create account. Please try again.'
            ], 500);
        }
       
    }
}
