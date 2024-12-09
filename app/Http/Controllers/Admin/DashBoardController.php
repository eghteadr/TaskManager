<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
class DashBoardController extends Controller
{
    private $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function index(){
            $users = $this->userRepository->selectSopervisior();
            if (!auth()->check()) {
                return redirect()->route('login');
            }

            return view('admin.dashboard' , compact('users'));
    }




}
