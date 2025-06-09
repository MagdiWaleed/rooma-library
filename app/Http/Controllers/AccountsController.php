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

        
        if ($request->hasFile('photo')) {
           $file = $request->file('photo');
            Log::info('uploadImage function called');
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        if($file->move('Uploads',$filename)){
            Log::info('File uploaded successfully: ' . $filename);
        } else {
            Log::error('Failed to move uploaded file');
        }
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
    function saveUploadedImage($fileInputName, $uploadDir = 'D:\prorgamming shit\rooma-library\public\assets\uploads'): array {
    Log::info('saveUploadedImage function called with file input name: ' . $fileInputName);
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if (!isset($_FILES[$fileInputName]) || $_FILES[$fileInputName]['error'] !== UPLOAD_ERR_OK) {
        return ["state"=>false,'error' => 'No file uploaded or upload error occurred'];
    }

    $file = $_FILES[$fileInputName];

    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    if (!in_array($file['type'], $allowedTypes)) {
        return ["state"=>false,'error' => 'Only JPG, PNG, GIF, and WEBP files are allowed'];
    }

    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = uniqid() . '.' . $extension;
    $destination = $uploadDir . $filename;

    if (move_uploaded_file($file['tmp_name'], $destination)) {
        return ["state"=>true,'path' => $destination, 'basename'=>$filename];
    } else {
        return ["state"=>false,'error' => 'Failed to move uploaded file'];
    }
}
   
}
