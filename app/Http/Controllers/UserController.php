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
    //to save the uploaded file to local storage 
     if($request->cr) {
        $fileName = time().'_'.$request->cr->getClientOriginalName();
        $filePath = $request->cr->storeAs('uploads', $fileName, 'public');
    
        // $user->fileName = time().'_'.$request->cr->getClientOriginalName();
        $user->cr = '/storage/' . $filePath;    

    }
    
   //   dd($user->id);
   // $db  = User::where("id","=",$user->id);
   // dd($db);
   // $test = 'hellooo thereee';
     $user->save();
     $id = $user->id;
   //   dd($id);
   //   dd('mariam'.$id.'.html');
     Storage::put('User'.$id.'.html',$user); 

     
   //  Storage::disk('local')->put('example.txt', 'Contents');
   //  dd($user);
    $pdf = PDF::loadFile('/var/www/laravel/Form/storage/app/User'.$id.'.html');
    $pdf->setPaper('a4', 'landscape')->save('/var/www/laravel/Form/public/files/User'.$id.'.pdf');
     return response([
        'data'=> new UserResource($user),
        'success' => 'Your data has been sent successfully'
    ],Response::HTTP_CREATED);

   // $user->save();
        
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
