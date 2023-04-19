<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = "media";

    public static function createBulk($source_id, $source_type, $media_type, $data)
    {

        $qry_params = [];

        foreach ($data as $column => $media) {
            $qry_params[] = "($source_id, '$source_type', '$media_type', '$media', NOW()) ";
        }

        /*print 'INSERT INTO user (source_id, source_type, path, created_at) VALUES ' . implode(', ', $qry_params) ;
        exit;*/
        \DB::statement('INSERT INTO media (source_id, source_type, media_type, path, created_at) VALUES ' . implode(', ', $qry_params) . "");
        return true;

    }

    public static function getBySourceType($source_id, $source_type)
    {
        $query = self::select();
        return $query->where('source_id', $source_id)
            ->where('source_type', $source_type)
            ->whereNull('deleted_at')
            ->get();

    }
}
