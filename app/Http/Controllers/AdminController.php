<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Balance;


class AdminController extends Controller
{
    public function users()
    {
        return new User();
    }

    public function balance()
    {
        return new Balance();
    }

    public function index()
    {
        $users = $this->users()->getUsers();
        return view('admin.index', ['users' => $users]);

    }

    public function profile(Request $request, $id)
    {
        $users = $this->users()->getUsers(); //получаем список всех юзеров
        $user = $this->users()->getUser($id); //получаем текущего юзера
        $usersForTransfer = $this->users()->getUsersForTransfer($id); //получаем юзеров для перевода
        $currBalance = $this->balance()->UserBalance($id); //текущий баланс юзера
        $data = session()->get( 'data' );
        return view('admin.profile', [
            'user' => $user,
            'users' => $users,
            'id' => $id,
            'balance' => $currBalance,
            'usersForTransfer' => $usersForTransfer,
            'data' => $data
        ]);
    }
}

