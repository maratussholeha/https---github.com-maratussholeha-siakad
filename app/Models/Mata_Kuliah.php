<?php
/*
    Nama file   : Mata_Kuliah.php
    NIM         : 3202416144
    Nama        : Mar'atussholeha
   
*/
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Mata_Kuliah extends Model
{
	protected $table = 'mata_kuliah';
	
	protected $primaryKey = 'id';
	
	protected $fillable = ['kode_mk', 'nama_mk', 'sks'];
	
	public function krs(): BelongsToMany
	{
		return $this->belongsToMany(Krs::class, 'krs_detail', 'mata_kuliah_id', 'krs_id')
			->withTimestamps();
	}
    
}
