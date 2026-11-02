<?php
/*
    Nama file   : KrsDetail.php
    NIM         : 3202416144
    Nama        : Mar'atussholeha
   
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KrsDetail extends Model
{
	protected $table = 'krs_detail';
	
	protected $fillable = ['krs_id', 'mata_kuliah_id'];
	
	public function krsDetail(): BelongsTo
	{
		return $this->belongsTo(Krs::class, 'krs_id');
	}
	public function mataKuliah(): BelongsTo
	{
		return $this->belongsTo(MataKuliah::class, 'mata_kuliah_id');
	}
}
