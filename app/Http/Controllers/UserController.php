<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\User;

class UserController extends Controller
{
    /**
     * List all users for the authenticated developer.
     */
    public function index(Request $r)
    {
        $users = $r->developer->users()->get();

        return response()->json([
            'message' => 'Users retrieved successfully.',
            'data'    => $users,
        ], 200);
    }

    /**
     * Create a new user under the authenticated developer.
     */
    public function store(Request $r)
    {
        $devId = $r->developer->id;

        $data = $r->validate([
            'phone' => [
                'required',
                Rule::unique('users')
                    ->where(fn($q) => $q->where('developer_id', $devId))
            ],
            'email' => [
                'nullable', 'email',
                Rule::unique('users')
                    ->where(fn($q) => $q->where('developer_id', $devId))
            ],
            'status'         => 'required|in:active,inactive',
            'uid'            => 'required',
            'remaining_days' => 'required|integer',
            'password'       => 'nullable',
            'username'       => 'nullable',
        ]);

        if (! empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        $data['developer_id'] = $devId;

        $user = User::create($data);

        return response()->json([
            'message' => 'User created successfully.',
            'data'    => $user,
        ], 201);
    }

    /**
     * Retrieve a single user by ID (must belong to authenticated developer).
     */
    public function show(Request $r, $id)
    {
        $user = $r->developer->users()->findOrFail($id);
        
                if (! $user) {
            return response()->json([
                'message' => 'User not found.'
            ], 404);
        }

        return response()->json([
            'message' => 'User retrieved successfully.',
            'data'    => $user,
        ], 200);
    }

    /**
     * Update an existing user.
     */
    public function update(Request $r, $id)
    {
        $devId = $r->developer->id;
        $user  = $r->developer->users()->findOrFail($id);
        
                if (! $user) {
            return response()->json([
                'message' => 'User not found.'
            ], 404);
        }

        $data = $r->validate([
            'phone' => [
                'required',
                Rule::unique('users')
                    ->ignore($id)
                    ->where(fn($q) => $q->where('developer_id', $devId))
            ],
            'email' => [
                'nullable', 'email',
                Rule::unique('users')
                    ->ignore($id)
                    ->where(fn($q) => $q->where('developer_id', $devId))
            ],
            'status'         => 'required|in:active,inactive',
            'uid'            => 'required',
            'remaining_days' => 'required|integer',
            'password'       => 'nullable',
            'username'       => 'nullable',
        ]);

        if (! empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        $user->update($data);

        return response()->json([
            'message' => 'User updated successfully.',
            'data'    => $user,
        ], 200);
    }

    /**
     * Delete a user.
     */
    public function destroy(Request $r, $id)
    {
        $user = $r->developer->users()->find($id);

        if (! $user) {
            return response()->json([
                'message' => 'User not found.'
            ], 404);
        }

        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully.',
        ], 200);
    }

    /**
     * Authenticate a user under the authenticated developer.
     */
    public function login(Request $r)
    {
        $devId = $r->developer->id;

        $data = $r->validate([
            'phone'    => 'required_without:email',
            'email'    => 'required_without:phone|email',
            'password' => 'required',
        ]);

        // Build query scoped to this developer
        $query = $r->developer->users();
        if (isset($data['email'])) {
            $query->where('email', $data['email']);
        } else {
            $query->where('phone', $data['phone']);
        }

        $user = $query->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials.',
            ], 401);
        }

        return response()->json([
            'message' => 'Login successful.',
            'data'    => $user,
        ], 200);
    }
}