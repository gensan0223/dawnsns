<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UsersController extends Controller
{
    //

    public function profile(){
        $loginUser = Auth::user();
        return view('users.profile',compact('loginUser'));
    }
    public function search(Request $request){
        $loginUser = Auth::user();
        //ログインユーザのフォローしている人数
        $follow = $loginUser->followUsers;
        $followCount = $follow->count();
        //ログインユーザのフォローされている人数
        $follower = $loginUser->followerUsers;
        $followerCount = $follower->count();

        //ユーザ一覧
        $users = User::all();

        //検索
        $keyword = $request->input('search');
        if(!empty($keyword)){
            $users = User::where('username', $request->input)->first();
        }

        return view('users.search', compact('loginUser', 'followCount', 'followerCount', 'users'));
    }
}
