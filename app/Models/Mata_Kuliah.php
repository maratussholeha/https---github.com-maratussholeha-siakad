<?php
/*
    Nama file   : Mata_Kuliah.php
    NIM         : 3202416144
    Nama        : Mar'atussholeha
   
*/
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mata_Kuliah extends Model
{
	protected $table = 'mata_kuliah';
	
	protected $fillable = ['kode_mk', 'nama_mk', 'sks'];
	
	public function krsDetail(): HasMany
	{
		return $this->hasMany(KrsDetail::class, 'mata_kuliah_id');
	}
    
}
