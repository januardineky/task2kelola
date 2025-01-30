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
        $users = User::all();
        $total = $users->where('rolename', 'User')->count();;
        $totaladmin = $users->where('rolename', 'Admin')->count();
        return view("index", compact( 'total', 'totaladmin'));
    }

    public function getUsers(Request $request)
    {

        $users = User::when($request->has('search') && !empty($request->search), function ($query) use ($request) {
            $fields = ['username', 'address', 'major'];
            
            foreach($fields as $index => $field) {
                if ($index === 0) {
                    $query->where($field, 'LIKE', "%{$request->search}%");
                } else {
                    $query->orWhere($field, 'LIKE', "%{$request->search}%");
                }
            }
        })
            ->when($request->has('sort_major') && $request->sort_major != '', function ($query) use ($request) {
                $query->where('major', $request->sort_major);
            })
            ->when($request->has('sort_role') && $request->sort_role != '', function ($query) use ($request) {
                $query->where('rolename', $request->sort_role);
            })
            ->paginate(10);


        // $query = User::where('rolename', 'user');
        // $query = User::query();

        // if ($request->has('search') && $request->search != '') {
        //     $query->where('username', 'like', '%' . $request->search . '%')
        //         ->orWhere('address', 'like', '%' . $request->search . '%')
        //         ->orWhere('major', 'like', '%' . $request->search . '%');
        // }

        // if ($request->has('sort_major') && $request->sort_major != '') {
        //     $query->where('major', $request->sort_major);
        // }

        // if ($request->has('sort_role') && $request->sort_role != '') {
        //     $query->where('rolename', $request->sort_role);
        // }

        // $tabel = $query->paginate(10);

        return view('users', ['tabel' => $users]);
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
