<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Micropost;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        // idの値で投稿を検索して取得
        $micropost = Micropost::findOrFail($id);
        // その投稿をいいねしているユーザを取得
        // $favoUser =  $micropost->feed_microposts()->paginate(10);
        
        $favoriteUsers = $micropost->favorite_users()->paginate(10);
        
        // 投稿のいいねユーザ一覧を表示
        return view('favorites.user', [
            'user' => $user,
            'favoriteUsers' => $favoriteUsers,
        ]);
        
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($micropostid)
    {
        //認証済みユーザがidの投稿をいいねする
        \Auth::user()->favorite($micropostid);
        return back();
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($micropostid)
    {
        //認証済みユーザがidの投稿をいいねする
        \Auth::user()->unfavorite($micropostid);
        return back();
    }
}
