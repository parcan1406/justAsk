<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 14.01.18
 * Time: 13:34
 */

namespace App\Http\Controllers\Admin;


use App\User;

class UserController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(15);

        return view('admin.user.index', compact('users'));
    }

}