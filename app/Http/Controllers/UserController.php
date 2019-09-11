<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(5);
        return view('user/user', compact('users'));
    }

    public function employees(){
        $employees = User::where("level","2")->paginate(5);
        return view('user/employees',compact('employees'));
    }

    public function upgradeUser($id){
        $user = User::find($id);
        $user->level = 2;
        $user->save();
        return redirect('user');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([  
            'firstname' => 'required',
            'lastname' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg',
        ]);

        $user = User::find($id);
        $user->firstname = $data['firstname'];
        $user->lastname = $data['lastname'];
        $user->phone_number = $data['phone_number'];
        $user->email = $data['email'];
        if ($request->has('image')) {
            $imagePath = $request->file('image')->store("uploads", "public");
            $user->img = "storage/".$imagePath;
        }
        //$user->gender = $data['gender'];
        //$user->level = $data['level'];
        //$user->city_id = $data['city_id'];
        //$user->street_id = $data['street_id'];
        //$user->date_of_birth = $data['date_of_birth'];
        $user->save();
        return redirect('user');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('usershow',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $this->authorize('update', $user);
        return view('user/userupdate', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([  
            'firstname' => 'required',
            'lastname' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg',
        ]);

        $user = User::find($id);
        $user->firstname = $data['firstname'];
        $user->lastname = $data['lastname'];
        $user->phone_number = $data['phone_number'];
        $user->email = $data['email'];
        if ($request->has('image')) {
            $imagePath = $request->file('image')->store("uploads", "public");
            $user->img = "storage/".$imagePath;
        }
        //$user->gender = $data['gender'];
        //$user->level = $data['level'];
        //$user->city_id = $data['city_id'];
        //$user->street_id = $data['street_id'];
        //$user->date_of_birth = $data['date_of_birth'];
        $user->save();
        return redirect('user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('user');
    }
}
