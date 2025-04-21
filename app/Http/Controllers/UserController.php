<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $r)
    {
        return $r->developer->users()->get();
    }

    public function store(Request $r)
    {
        $data = $r->validate([
            'phone'=>'required','status'=>'required',
            'uid'=>'required','remaining_days'=>'required|integer',
            'email'=>'nullable|email','password'=>'nullable',
            'username'=>'nullable'
        ]);
        if ($data['password'] ?? false) {
            $data['password'] = bcrypt($data['password']);
        }
        $data['developer_id'] = $r->developer->id;
        return User::create($data);
    }

    public function show(Request $r, $id)
    {
        return $r->developer->users()->findOrFail($id);
    }

    public function update(Request $r, $id)
    {
        $user = $r->developer->users()->findOrFail($id);
        $data = $r->validate([
            'phone'=>'required','status'=>'required',
            'uid'=>'required','remaining_days'=>'required|integer',
            'email'=>'nullable|email','password'=>'nullable',
            'username'=>'nullable'
        ]);
        if ($data['password'] ?? false) {
            $data['password'] = bcrypt($data['password']);
        }
        $user->update($data);
        return $user;
    }

    public function destroy(Request $r, $id)
    {
        $r->developer->users()->findOrFail($id)->delete();
        return response()->noContent();
    }
}
