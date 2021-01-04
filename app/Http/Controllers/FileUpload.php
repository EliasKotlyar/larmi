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

    public function convertPdfToImages($fileName)
    {
        $tmpDirectory = Storage::path("public/tmp");
        $outputFiles = $tmpDirectory . "/files-%02d.jpg";
        $cmd = "gs -sDEVICE=pngalpha -o " . $outputFiles . " -r96 " . $fileName;
        shell_exec($cmd);
        $retArr = [];
        $files = Storage::files("public/tmp/");
        foreach ($files as $fileName) {
            $extension = $this->getFileExtension($fileName);
            if ($extension == "jpg") {
                $retArr[] = $fileName;
            }
        }
        return $retArr;
    }

    public function convertPowerPointToPdf($fileName)
    {
        $tmpDirectory = Storage::path("public/tmp");
        $tmpFile = $tmpDirectory . "/tmp.pdf";
        $cmd = "unoconv -f pdf  -o " . $tmpFile . " " . $fileName;
        shell_exec($cmd);
        return $tmpFile;
    }

    public function saveSlides($imageFiles, $fileModel)
    {
        foreach ($imageFiles as $imageFile) {
            $slideModel = new Slide();
            $slideModel->file_id = $fileModel->id;
            $slideModel->save();
            $newFileName = "public/slides/" . $slideModel->id . ".jpg";
            Storage::move($imageFile, $newFileName);
            $slideModel->path = $newFileName;
            $slideModel->save();
        }
    }

    public function saveFile(\Illuminate\Http\UploadedFile $file)
    {
        $fileModel = new File;
        $fileModel->name = $file->getClientOriginalName();
        $fileModel->save();
        $fileName = $fileModel->id . "." . $this->getFileExtension($fileModel->name);
        $filePath = $file->storeAs('public/files', $fileName);
        $fileModel->file_path = $filePath;
        $fileModel->save();
        return $fileModel;
    }

    public function fileUpload(Request $req)
    {
        /*
        $req->validate([
            'file' => 'required|mimes:pptx,pdf|max:2048'
        ]);
        */
        if (!$req->file()) {
            throw new \Exception('No File Provided!');
        }
        $file = $req->file;
        $mimeType = $file->getMimeType();
        switch ($mimeType) {
            case "application/pdf":
                $fileModel = $this->saveFile($file);
                $images = $this->convertPdfToImages($fileModel->getPath());
                $this->saveSlides($images, $fileModel);
                break;
            case "application/vnd.oasis.opendocument.presentation":
            case "application/vnd.openxmlformats-officedocument.presentationml.presentation":
                $fileModel = $this->saveFile($file);
                $tmpFile = $this->convertPowerPointToPdf($fileModel->getPath());
                $images = $this->convertPdfToImages($tmpFile);
                $this->saveSlides($images, $fileModel);
                break;
            default:
                throw new \Exception('Filetype not supported!');
                break;
        }


        return back()
            ->with('success', 'File has been uploaded.');
        //->with('file', $fileName);

    }

}
