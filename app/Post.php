<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'slug'];

    public static function generateUniqueSlug($string){
        $slug = Str::slug($string, '-');
        $slug_base = $slug;

        $slug_esistente = Post::where('slug', $slug)->first();

        $c = 1;

        while($slug_esistente){
            $slug = $slug_base.'-'.$c;
            $c++;
            $slug_esistente = Post::where('slug', $slug)->first();
        }
   
        return $slug;
    }
}
