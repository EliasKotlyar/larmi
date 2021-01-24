<?php

namespace App\Http\Controllers\Admonitor;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Storage;

class FileUploadDialog extends Controller
{
    public function viewAction()
    {
        return view('admonitor/fileupload');
    }


}
