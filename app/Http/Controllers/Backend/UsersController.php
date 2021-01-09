<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Role;
use App\Event;
use App\Notifications\CreditsReminder;

class UsersController extends Controller
{
    protected $paginateNum = 7;
    protected $uploadPath;

    public function __construct()
    {
        parent::__construct();
        $this->uploadPath = public_path('images'); 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(($status = $request->get('status')) && $status == 'trash')
        {
            $users         = User::onlyTrashed()->paginate($this->paginateNum);
            $onlyTrashed   = TRUE;
        }
        else 
        {
            $users         = User::paginate($this->paginateNum);
            $onlyTrashed   = FALSE;
        }

        $statusList = $this->statusList();

        return view('booking-rooms.users.index', compact('users', 'onlyTrashed', 'statusList'));
    }

    private function statusList()
    {
        return [
            'all'   => User::count(),
            'trash' => User::onlyTrashed()->count()
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $users)
    {
        return view('booking-rooms.users.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\UsersStoreRequest $request)
    {   
        $data = $request->all();
        $data   = request()->except($data['add_role']);
        $data['password'] = bcrypt($data['password']);
        
        if($request->hasFile('image'))
        {
            $image          = $request->file('image');
            $fileName       = $image->getClientOriginalName();
            $destination    = $this->uploadPath;
            
            $successUploaded = $image->move($destination, $fileName);

            $data['image'] = $fileName;
        }
        $users  = User::create($data);
        
        $userName = User::whereName($data['name'])->first();
    
        if(isset($data['add_role']))
        {
            $userName->attachRole($data['add_role']);
        }

        return redirect('/backend/users')->with('message', 'User added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $user = User::where('slug', $slug)->firstOrFail();

        return view('booking-rooms.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $users = User::where('slug', $slug)->firstOrFail();

        return view('booking-rooms.users.edit', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UsersUpdateRequest $request, $id)
    {
        $data       = $request->all();
        $userName   = User::where('id', $id)->first();
        $data       = $this->handleRequest($data, $userName);
        
        if($request->hasFile('image'))
        {
            $image          = $request->file('image');
            $fileName       = $image->getClientOriginalName();
            $destination    = $this->uploadPath;
            
            $successUploaded = $image->move($destination, $fileName);

            $data['image'] = $fileName;
        }
        
        User::findOrFail($id)->update($data);
        

        return redirect('/backend/users')->with('message', 'User updated successfully!');
    }

    private function handleRequest($data, $userName)
    {
        $rolesAll = Role::all();

        if(is_null($data['password']) && !isset($data['add_role']))
        {  
            $data = request()->except(['password', 'add_role']);
        }
        elseif(is_null($data['password']) && isset($data['add_role']))
        {
            $data = request()->except('password');

            foreach($rolesAll as $role)
            {
                $userName->detachRole($role);
            }
            $userName->attachRole($data['add_role']);
           
        }
        elseif(!is_null($data['password']) && !isset($data['add_role']))
        {
            $data = request()->except('add_role');
            $data['password'] = bcrypt($data['password']);
        }
        elseif(!is_null($data['password']) && isset($data['add_role']))
        {
            $data['password'] = bcrypt($data['password']);
        }
        
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        Event::where('user_id', $id)->delete();

        return redirect('/backend/users')->with('user-trash-message', ['Your user was moved to trash!', $id]);
    }

    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $event = Event::where('user_id', $id);
        $user->restore();
        $event->restore();

        return redirect()->back()->with('message', 'Your user was moved from trash!');
    }

    public function forceDestroy($id)
    {
        User::withTrashed()->findOrFail($id)->forceDelete();

        return redirect('/backend/users?status=trash')->with('message', 'Your user has been deleted successfully!');
    }

    public function reminder($id)
    {
        $user = User::where('id', $id)->firstOrFail();

        if($user->credits <= 500)
        {
            //notifiy the user  about the low credits
            $id = $user->id;
            $user->notify(new CreditsReminder(User::findOrFail($id)));
            
            return redirect()->back()->with('message', 'Reminder successfully sent');
        }
       

    }
}
