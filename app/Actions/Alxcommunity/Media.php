<?php
namespace App\Actions\Alxcommunity;
use App\Models\Media as med;
use Illuminate\Support\Facades\Storage;

class Media
{
     
     static public function create($files, $upload_path, $parent)
     {
          if(!is_array($files)){
               $files = array($files);
          }
          foreach ($files as $image) {
              $imageModel = new med();
              $path = Storage::disk('public_uploads')->put($upload_path, $image);
              $imageModel->mediaable()->associate($parent);
              $imageModel->path = $path;
              $imageModel->save();
          }
          return "";
     }
}
