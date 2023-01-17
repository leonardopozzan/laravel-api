<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name','slug','description','framework','team','git_link','diff_lvl', 'image','type_id'];

    public static function generateSlug($name){
        return Str::slug($name, '-');
    }
    public function type() :BelongsTo{
        return $this->belongsTo(Type::class);
    }

    public function languages():BelongsToMany{
        return $this->belongsToMany(Language::class);
    }
}
