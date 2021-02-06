<?php

namespace App\Models;

use App\Scopes\CommandScope;
use Illuminate\Database\Eloquent\Model;

class Command extends Model
{
    protected  $table ="commands";
    protected $fillable=['nom_ar','photo','nom_en','prix','article_ar','article_en','created_at','updated_at','status'];
    protected $hidden=['created_at','updated_at'];
    public $timestamps=false;

    // Local scope

    public function scopeInactive($query){

        return $query->where('status',0);
    }

    //global scope

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new CommandScope);
    }

//Mutators

    public function setNomEnAttribute($val){
        $this->attributes['nom_en'] = strtoupper($val);
    }
}
