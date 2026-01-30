<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Admin\User\UserRepository;

class UserController extends Controller
{
    protected $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    // -----------------
    // List Users View
    // -----------------
    public function index()
    {
        return view('admin.users.listUser');
    }

    // -----------------
    // Datatable AJAX
    // -----------------
    public function table(Request $request)
    {
        $query = $this->users->getForDataTable([
            'search'    => $request->search,
            'status'    => $request->status,
            'role'      => $request->role,
            'date_from' => $request->date_from,
            'date_to'   => $request->date_to,
        ]);

        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('created_at', fn($user) => $user->created_at->format('d M Y'))
            ->addColumn('action', fn($user) => view('admin.users.columns._actions', compact('user'))->render())
            ->rawColumns(['action'])
            ->make(true);
    }

    // -----------------
    // Create User
    // -----------------
    public function create(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $this->users->create($request->only('name', 'email', 'password'));

        return response()->json(['success' => true]);
    }

    // -----------------
    // Edit User
    // -----------------
    public function edit($id)
    {
        $user = $this->users->find($id);
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found'], 404);
        }

        return response()->json($user);
    }

    // -----------------
    // Update User
    // -----------------
    public function update(Request $request)
    {
        $request->validate([
            'id'    => 'required|exists:users,id',
            'name'  => 'required',
            'email' => 'required|email|unique:users,email,' . $request->id,
        ]);

        $user = $this->users->find($request->id);
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found'], 404);
        }

        $this->users->update($user, $request->only('name', 'email', 'password'));

        return response()->json(['success' => true]);
    }

    // -----------------
    // Delete User
    // -----------------
    public function destroy(Request $request)
    {
        $request->validate(['id' => 'required|exists:users,id']);

        $user = $this->users->find($request->id);
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found'], 404);
        }

        $this->users->delete($user);

        return response()->json(['success' => true]);
    }
}
