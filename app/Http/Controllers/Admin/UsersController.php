<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Http\Requests\StoreUserRequest;
class UsersController extends Controller
{
    private $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->all();
        return view('admin.users' , compact('users'));
    }
    public function create()
    {
        return view('admin.create-users');
    }
    public function store(StoreUserRequest $request)
    {
        $createUser = $this->userRepository->create($request->validated());
        return redirect()->back()->with($createUser ? 'success' : 'error', $createUser ? 'کاربر با موفقیت ایجاد شد' :
            'در هنگام دخیره سازی مشکلی رخ داده است');
    }
    public function destroy($id)
    {
        $deleteUser = $this->userRepository->delete($id);
        return redirect()->back()->with(
            $deleteUser ? 'success' : 'error',
            $deleteUser ? 'کاربر با موفقیت حذف شد' : 'عملیات با خطا مواجه شد'
        );
    }


}
