<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Storage;

class FileUpload extends Controller
{
    public function createForm()
    {
        return view('file-upload');
    }

    public function getFileExtension($fileName)
    {
        return pathinfo($fileName, PATHINFO_EXTENSION);
    }

    public function fileUpload(Request $req)
    {
        /*
        $req->validate([
            'file' => 'required|mimes:pptx,pdf|max:2048'
        ]);
        */

        $fileModel = new File;

        if ($req->file()) {
            $timeStamp = time();
            $extension = $this->getFileExtension( $req->file->getClientOriginalName());
            $tmpDirectory = Storage::path("public/tmp");
            $tmpFile = $tmpDirectory . "/" . $timeStamp . "-tmp.pdf";
            if ($extension == "pptx" || $extension == "ppt"){
                $fileName = $timeStamp . ".pptx";
                $filePath = $req->file('file')->storeAs('public/uploads', $fileName);
                $origFile = Storage::path($filePath);
                $fileModel->name = $req->file->getClientOriginalName();
                $fileModel->file_path = '/storage/' . $filePath;
                $fileModel->save();
                $cmd = "unoconv -f pdf  -o " . $tmpFile . " " . $origFile;
                shell_exec($cmd);

            }else if($extension == "pdf"){
                $fileName = $timeStamp . ".pdf";
                $tmpFile = $req->file('file')->storeAs('public/uploads', $fileName);
                $fileModel->name = $req->file->getClientOriginalName();
                $fileModel->file_path = '/storage/' . $tmpFile;
                $fileModel->save();

            }





            $outputFiles = $tmpDirectory . "/files-%02d.jpg";
            $cmd = "gs -sDEVICE=pngalpha -o " . $outputFiles . " -r96 " . $tmpFile;
            shell_exec($cmd);
            //die($cmd);

            $files = Storage::files("public/tmp/");
            foreach ($files as $fileName) {
                $extension = $this->getFileExtension($fileName);
                if ($extension == "jpg") {
                    $slideModel = new Slide();
                    $slideModel->file_id = $fileModel->id;
                    $slideModel->save();
                    $newFileName = "public/slides/" . $slideModel->id . ".jpg";
                    Storage::move($fileName, $newFileName);
                    $slideModel->path = $newFileName;
                    $slideModel->save();
                }
            }
            //print_r($files);
            //die();


            return back()
                ->with('success', 'File has been uploaded.')
                ->with('file', $fileName);
        }
    }

}
