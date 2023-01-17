<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;


class Type extends Model
{
    use HasFactory;

    protected $fillable = ['workflow','slug'];

    public static function generateSlug($name){
        return Str::slug($name, '-');
    }

    public function projects() :HasMany{
        return $this->hasMany(Project::class);
    }
    // public static function findType($id){
    //     $type = Type::select('workflow')->where('id', $id)->get();
    //     if(count($type)){
    //         return $type['0']->workflow;
    //     }else{
    //         return '/';
    //     }
    // }
}
