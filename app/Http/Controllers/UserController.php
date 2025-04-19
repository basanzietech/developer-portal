<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller {
    public function index(Request $req) {
        $dev = $req->get('developer');
        return $dev->users;
    }
    public function store(Request $req) {
        $dev = $req->get('developer');
        $data = $req->validate([
            'phone'=>'required', 'status'=>'required',
            'uid'=>'required', 'remaining_days'=>'required|integer',
            'email'=>'nullable|email', 'password'=>'nullable',
            'username'=>'nullable'
        ]);
        $data['developer_id'] = $dev->id;
        $data['password'] = isset($data['password']) ? bcrypt($data['password']) : null;
        return User::create($data);
    }
    public function show(Request $req, $id) {
        return $req->get('developer')->users()->findOrFail($id);
    }
    public function update(Request $req, $id) {
        $dev = $req->get('developer');
        $user = $dev->users()->findOrFail($id);
        $data = $req->validate([ /* same as store */ ]);
        if(isset($data['password'])) $data['password']=bcrypt($data['password']);
        $user->update($data);
        return $user;
    }
    public function destroy(Request $req, $id) {
        $dev = $req->get('developer');
        $dev->users()->findOrFail($id)->delete();
        return response()->noContent();
    }
}