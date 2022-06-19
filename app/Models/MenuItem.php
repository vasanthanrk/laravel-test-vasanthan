<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model{
    
    public function menus(){
        return $this->hasMany('App\Models\MenuItem', 'parent_id');
    }

    public function childrenMenus(){
        return $this->hasMany('App\Models\MenuItem', 'parent_id')->with('menus');
    }

}
