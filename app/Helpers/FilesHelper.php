<?php

namespace App\Helpers;
use Storage;
use File;

class FilesHelper
{
    /**
     * Store file
     *
     */
    static function storeFile($folder, $request_file, $title = null)
    {
        $tmp_file = $request_file;

        if(isset($title) && $title){
            // Custom title path
            $tmp_file_name = strtolower(str_replace(" ", "-", $title));
        } else {
            // Original image name path
            $tmp_file_name = basename($tmp_file->getClientOriginalName(), '.'.$tmp_file->getClientOriginalExtension());
        }
        $tmp_file_name = preg_replace('/[^A-Za-z0-9\-]/', '', $tmp_file_name);
        $tmp_file_extension = $tmp_file->getClientOriginalExtension();
        $original_name = $tmp_file_name . "-" . rand(0000, 9999) . "." . $tmp_file_extension;

        // Random title path
        // $tmp_file_extension = $tmp_file->getClientOriginalExtension();
        // $original_name = rand() . "." . $tmp_file_extension;

        $file = $tmp_file->storeAs('public/'.$folder, $original_name);
        $file_path = Storage::url($file);

        return $file_path;
    }

    /**
     * Delete file function
     *
     */
    static function deleteFile($path)
    {
        if(File::exists($path)){
            File::delete($path);
        }
    }
}