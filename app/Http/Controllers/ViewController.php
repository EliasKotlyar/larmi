<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function viewAction(File $file)
    {
        return view('slider', ["slides" => $file->slides]);
    }
}
