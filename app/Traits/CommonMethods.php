<?php


namespace App\Traits;


use Illuminate\Support\Facades\Storage;

trait CommonMethods
{
    /**
     * @param $file
     * @param $path
     * @return bool
     */
    private function uploadFile($file,$path)
    {
        // TODO: Implement uploadFile() method.
        $path = Storage::disk('public')->put($path, $file);
        return $path;
    }
}
