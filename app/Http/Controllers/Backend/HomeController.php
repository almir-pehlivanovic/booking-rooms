<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    protected $uploadPath;

    public function __construct()
    {
        parent::__construct();
        $this->uploadPath = public_path('images'); 
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('booking-rooms.home');
    }

    public function edit(Request $request)
    {
        $users = $request->user();

        return view('booking-rooms.show', compact('users'));
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $storeData = $request->validate([
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email,'. auth()->user()->id,
            'password'  => 'required_with:password_confirmation|confirmed',
            'role'      => 'required'
        ]);
        
        $user = $request->user();

        if(is_null($request->password))
        {
            $data = $request->except(['password', 'status']);
        }
        else{
            $data['password'] = bcrypt($data['password']);
        }

        if($request->hasFile('image'))
        {
            $image          = $request->file('image');
            $fileName       = $image->getClientOriginalName();
            $destination    = $this->uploadPath;
            
            $successUploaded = $image->move($destination, $fileName);

            $data['image'] = $fileName;
        }

        $user->update($data);
        
        return redirect()->back()->with("message", "Account was updated successfully!");
    }
}
