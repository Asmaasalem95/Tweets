<?php


namespace App\Traits;


use Illuminate\Support\Facades\Storage;

trait CommonMethods
{
    /**
     * @param $image
     * @param $path
     * @return bool
     */
    private function uploadFile($image,$path)
    {
        // TODO: Implement uploadFile() method.
        $path = Storage::disk('public')->put($path, $image);
        return $path;
    }
}
