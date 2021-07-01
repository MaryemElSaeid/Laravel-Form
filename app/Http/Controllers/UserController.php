<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Requests\UserRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EmailsController;
use Exception;
use Storage;
use \PDF;

class UserController extends Controller
{

public function __construct()
 {
    
 }


public function index()
 {
    // $contents = Storage::get('file.jpg');
    // return $contents;
    return UserResource::collection(User::all());
 }


public function create()
 {
    //
 }

public function store(UserRequest $request)
 { 
    // $name = time().'_'.$request->cr->getClientOriginalName();
    //  dd($request->cr->storeAs('uploads', $name, 'public'));
    // dd($request->cr->file);
     $user = new User($request->all());
    //  $request->cr->store('public');
     if($request->cr) {
        $fileName = time().'_'.$request->cr->getClientOriginalName();
        $filePath = $request->cr->storeAs('uploads', $fileName, 'public');
    
        // $user->fileName = time().'_'.$request->cr->getClientOriginalName();
        $user->cr = '/storage/' . $filePath;    
        // return back()
        // ->with('success','File has uploaded to the database.')
        // ->with('file', $name);
    }
     $user->save();
   //   $pdf = PDF::loadView()
   //  dd($user);
    $pdf = PDF::loadView($this->user, $user);
     return response([
        'data'=> new UserResource($user),
         $pdf->stream('invoiceoioiio.pdf'),
        'success' => 'Your data has been sent successfully'
    ],Response::HTTP_CREATED);
        
 }





public function show()
 {  
    //
 }

public function edit()
 {
    //
 }

public function update()
 {
    //
 }

public function destroy()
 {
    //
 }



 

}
