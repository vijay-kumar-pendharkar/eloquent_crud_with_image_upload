<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\User;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|digits:10',
            'address' => 'required|string|max:500',
            'image' => 'sometimes|file|mimes:jpeg,jpg,png|max:2048',
            'document' => 'sometimes|file|mimes:pdf,doc,docx|max:2048',
        ]);
    
        $imageName = null;
        $documentName = null;
    
        // ✅ Image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('uploads/images'), $imageName);
        }
    
        // ✅ Document upload
        if ($request->hasFile('document')) {
            $document = $request->file('document');
            $documentName = time().'_'.$document->getClientOriginalName();
            $document->move(public_path('uploads/documents'), $documentName);
        }
    
        User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'mobile'=> $request->mobile,
            'address'=> $request->address,
            'image' => $imageName ? 'uploads/images/'.$imageName : null,
            'document' => $documentName ? 'uploads/documents/'.$documentName : null,
        ]);
    
        return redirect()->route('users.index')->with('success','User created Successfully');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = User::findOrFail($id);
        return view('user.edit',compact('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
    
        $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'mobile' => 'required|digits:10',
            'address' => 'required|string|max:500',
            'image' => 'nullable|mimes:jpeg,jpg,png|max:2048',
            'document' => 'nullable|mimes:pdf,doc,docx|max:2048',
        ]);
    
        if ($request->hasFile('image')) {
            if ($user->image && File::exists(public_path($user->image))) {
                File::delete(public_path($user->image));
            }
    
            $imageName = time().'_'.$request->image->getClientOriginalName();
            $request->image->move(public_path('users/images'), $imageName);
            $user->image = 'users/images/'.$imageName;
        }
    
        if ($request->hasFile('document')) {
            if ($user->document && File::exists(public_path($user->document))) {
                File::delete(public_path($user->document));
            }
    
            $documentName = time().'_'.$request->document->getClientOriginalName();
            $request->document->move(public_path('users/documents'), $documentName);
            $user->document = 'users/documents/'.$documentName;
        }
    
        $user->name    = $request->name;
        $user->email   = $request->email;
        $user->mobile  = $request->mobile;
        $user->address = $request->address;
    
        $user->save();
    
        return redirect()->route('users.index')->with('success', 'User Updated Successfully');
    }
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success','User Deleted Success');
    }
}
