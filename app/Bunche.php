<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Selectable;

class Bunche extends Model
{
	use Selectable;
	
    protected $fillable = ['name', 'description'];
	
    public function subscribers(){
		return $this->hasMany(Subscriber::class);
	}
	
	public static function boot()
	{
		parent::boot();
		
		static::updating(function ($table) {
			$table->updated_by = Auth::user()->id;
		});
		
		static::creating(function ($table) {
			$table->created_by = Auth::user()->id;
			$table->updated_by = Auth::user()->id;
		});
	}
}
