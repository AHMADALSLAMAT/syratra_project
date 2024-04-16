<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;

class Helper
{
    public static function SaveSingleImage($folder, $file)
    {
        $path = public_path('uploade/' . $folder);
        $attachment_image = $file;
        $name_pdf = rand(1, 1000000) . '_' . $attachment_image->getClientOriginalName();
        // create folder
        if (!File::exists($path)) {
            File::makeDirectory($path, $mode = 0755, true, true);
        }
        $attachment_image->move($path, $name_pdf);
        $image_full_path = 'uploade/' . $folder . '/' . $name_pdf;
        return $image_full_path;
    }
    public static function SaveMultiImages($folder, $files)
    {
        if ($files != null) {
            $path = public_path('uploade/' . $folder);
            $all_images = [];
            foreach ($files as $file) {
                $attachment_image = $file;
                $name_pdf = rand(1, 1000000) . '_' . $attachment_image->getClientOriginalName();
                // create folder
                if (!File::exists($path)) {
                    File::makeDirectory($path, $mode = 0755, true, true);
                }
                $attachment_image->move($path, $name_pdf);
                $image_full_path = 'uploade/' . $folder . '/' . $name_pdf;
                array_push($all_images, $image_full_path);
            }
            return $all_images;
        }
    }
    public static function MerageArrayOnEdidt($name,$old_array,$new_array){
        // name image updates
        if(!empty($old_array)){
            if (empty($old_array) && empty($new_array)) {
                session()->flash('error', $name.' is required ');
                return back();
            } elseif (empty($old_array) || $old_array == null && !empty($new_array) && $new_array != null) {
                $name = $new_array;
            } elseif (!empty($new_array) && !empty($old_array) && $old_array != null && $new_array != null) {
                $name = $new_array;
                $name = array_merge($name, $old_array);
            } else {
                $name = $old_array;
            }
            return $name;
        }else{
            $name = $new_array;
            return $name;
        }
    }

}
