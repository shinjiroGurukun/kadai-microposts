<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Micropost extends Model
{
    //
    protected $fillable = ['content'];
    
    // この投稿の所有者ユーザ（id,name,email,password）
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    /**
     * この投稿をお気に入りしているユーザ
     */
     public function favorite_users(){
         return $this->belongsToMany(User::class,'favorites','micropost_id','user_id')->withTimestamps();
     }
     /**
     * この投稿をいいね中のユーザ
     */
     public function feed_microposts(){
        
        // この投稿をいいね中のユーザのidを取得して配列にする
        $userIds = $this->favorite_users()->pluck('users.id')->toArray();
        
        // このユーザのidもその配列に追加
        $userIds[] = $this->id;
        
        // var_dump($userIds);
        // それらのidのユーザを返す
        return Users::whereIn('id', $userIds);
     }
}