<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    //
    public function index()
    {
        return view('index');
    }

    public function count()
    {
        $users = User::all();
        $total = $users->where('rolename', 'User')->count();
        $totaladmin = $users->where('rolename', 'Admin')->count();
    
        return response()->json([
            'total' => $total,
            'totaladmin' => $totaladmin
        ]);
    }

    public function users()
    {
        return view('users');
    }

    public function getUsers(Request $request)
    {
        $users = User::select(['id', 'username', 'email', 'phone_number', 'address', 'major', 'status','rolename']);
        return DataTables::of($users)
        ->addColumn('action', function ($user) {
            return '<div class="d-flex">
                        <a href="#" class="btn btn-primary btn-sm me-3" title="Edit" onclick="openEditModal('.$user->id.')">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="#" class="btn btn-primary btn-sm" title="Delete" onclick="deleteUser('.$user->id.')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </div>';
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function store(RegisterRequest $request)
    {
        try {
            // Simpan user baru ke database
            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'major' => $request->major,
                'status' => $request->status, // Default active jika tidak dikirim
                'rolename' => $request->rolename, // Default ke User jika tidak dikirim
                'password' => bcrypt($request->password),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'User created successfully!',
                'user' => $user
            ], 201);
        } catch (Exception $e) {
            // Tangani error lainnya
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }


    public function edit($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    public function update(UpdateRequest $request, $id)
    {
        // Validasi
        $validate = $request->validated();

        try {
            // Temukan user
            $user = User::find($id);
            if (!$user) {
                throw new \Exception('User not found');
            }

            // Update data user
            $user->username = $validate['username'];
            $user->email = $validate['email'];
            $user->phone_number = $validate['phone_number'];
            $user->address = $validate['address'];
            $user->major = $validate['major'];
            $user->status = $validate['status'];
            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Update Success',
                'success' => true,
                'redirect' => '/admin/users'
            ], 200);
        } catch (\Exception $e) {
            // Tangani error jika user tidak ditemukan atau update gagal
            return response()->json([
                'status' => 'error',
                'message' => 'Update Gagal: ' . $e->getMessage(),
                'success' => false,
            ], 400);
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found!'
                ], 404);
            }

            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'User deleted successfully!'
            ]);
        } catch (\Exception $e) {
            Log::error('User Deletion Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting the user!',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
