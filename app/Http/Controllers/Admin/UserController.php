<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::orderBy('id', 'desc');

        if ($request->has('role') && $request->role !== 'all') {
            $query->where('role', $request->role);
        }

        $users = $query->get();

        return view('admin.user.index', compact('users'));
    }

    public function storeUser(Request $request)
    {
        // return response()->json($request->all());

        $data = $request->validate(
            [
                'name' => 'required|unique:users',
                'email' => 'required|email|unique:users',
                'password' => 'required',
                'role' => 'nullable|in:admin,customer,staff',
                'address' => 'nullable',
                'phone' => ['nullable','unique:users' ,'regex:/^(\+84|0[3|5|7|8|9])+([0-9]{8})$/'],
            ],
            [
                'name.required' => 'Tên không được để trống',
                'name.unique' => 'Tên đã tồn tại',
                'email.required' => 'Email không được để trống',
                'email.email' => 'Email không đúng định dạng',
                'email.unique' => 'Email đã tồn tại',
                'phone.regex' => 'Số điện thoại không đúng định dạng',
                'phone.unique' => 'Số điện thoại đã tồn tại',
                'password.required' => 'Mật khẩu không được để trống',
            ]
        );

        if ($request->hasFile('thumbnail')) {
            $filename = $request->file('thumbnail')->store('uploads/users', 'public');
        } else {
            $filename = null;
        }

        $user = new User();

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->address = $data['address'];
        $user->password = Hash::make($data['password']);
        $user->role = $data['role'];
        $user->phone = $data['phone'];
        $user->thumbnail = $filename;

        $user->save();
        return redirect()->route('admin.users.index');
    }


    //sửa 
    public function edit(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('admin.users.index');
        }
        return view('admin.user.edit', compact('user'));
    }

    // update
    public function update(Request $request, string $id)
    {
        $data = $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'address' => 'nullable',
                'role' => 'nullable|in:admin,customer,staff',
                'phone' => ['nullable', 'regex:/^(\+84|0[3|5|7|8|9])+([0-9]{8})$/'],
                'thumbnail' => 'nullable',
            ],
            [
                'name.required' => 'Tên không được để trống',
                'email.required' => 'Email không được để trống',
                'email.email' => 'Email không đúng định dạng',
                'phone.regex' => 'Số điện thoại không đúng định dạng',
                'password.required' => 'Mật khẩu không được để trống',
            ]
        );

        $user = User::find($id);

        if ($request->hasFile('thumbnail')) {
            if ($user->thumbnail) {
                Storage::disk('public')->delete($user->thumbnail);
            }
            // lưu ảnh mới
            $fileName = $request->file('thumbnail')->store('uploads/users', 'public');
        } else {
            $fileName = $user->thumbnail;
        }

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->address = $data['address'];
        $user->password = Hash::make($data['password']);

        $user->role = $data['role'];
        $user->phone = $data['phone'];
        $user->thumbnail = $fileName;

        $user->save();
        return redirect()->route('admin.users.index');
    }

    // xóa ngườii dùng
    public function destroy(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('admin.users.index');
        }

        if ($user->thumbnail) {
            Storage::disk('public')->delete($user->thumbnail);
        }

        $user->delete();
        return redirect()->route('admin.users.index');
    }
}
