<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	public $timestamps = false;
	
   	protected $fillable = ['title','description'];

	public function products()
	{
		return $this->belongsToMany('App\Product');
	}
}
