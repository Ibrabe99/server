<?php



use Illuminate\Support\Facades\Config;




function get_language(){
    return \App\Models\Language::active()->selection()->get();
}


function get_default_language(){
    return Config::get('app.locale');
}


function uploadImage($folder, $image)
{
    $path = $image->store('/', $folder);
    return 'assets/images/' . $folder . '/' . $image->hashName();
}

function uploadVideo($folder, $video)
{
    $video->store('/', $folder);
    $filename = $video->hashName();
    $filePath = 'video/' . $folder . '/' . $filename;
    return $filePath;
}

