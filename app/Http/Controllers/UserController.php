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
use DB;

class UserController extends Controller
{

public function __construct()
 {
    
 }


public function index()
 {

    return UserResource::collection(User::all());
 }


public function create()
 {
    //
 }

public function store(UserRequest $request)
 { 
     $user = new User($request->all());

     if($request->cr) {
        $fileName = time().'_'.$request->cr->getClientOriginalName();
        $filePath = $request->cr->storeAs('uploads', $fileName, 'public');
        $user->cr = '/storage/' . $filePath;    

    }
    
     $user->save();
     $id = $user->id;

    Storage::disk('public')->put('User'.$id.'.html',$user); 

    $pdf = PDF::loadFile(public_path('User'.$id.'.html')); 
    $pdf->setPaper('a4', 'landscape')->save(public_path('User'.$id.'.pdf'));
     return response([
        'data'=> new UserResource($user),
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