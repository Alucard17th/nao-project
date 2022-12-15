<?php

namespace App\Http\Controllers;


use App\Models\Document;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DocumentController extends Controller
{
    public function index()
    {
        return view('documents.index');
    }

    // Upload file

    public function uploadFile(Request $request)
    {

        $data = array();

        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:png,jpg,jpeg,pdf|max:2048'
        ]);

        if ($validator->fails()) {

            $data['success'] = 0;
            $data['error'] = $validator->errors()->first('file');// Error response

        } else {
            if ($request->file('file')) {

                $file = $request->file('file');
                $filename = time() . '_' . $file->getClientOriginalName();

                // File upload location
                $location = 'uploads';

                // Upload file
                $file->move($location, $filename);

                // Response
                $data['success'] = 1;
                $data['message'] = 'Uploaded Successfully!';

            } else {
                // Response
                $data['success'] = 0;
                $data['message'] = 'File not uploaded.';
            }
        }

        return response()->json($data);
    }

    public function readFiles()
    {
        $directory = 'uploads';
        $files_info = [];
        $file_ext = array('png', 'jpg', 'jpeg', 'pdf');

        // Read files
        foreach (File::allFiles(public_path($directory)) as $file) {
            $extension = strtolower($file->getExtension());

            if (in_array($extension, $file_ext)) { // Check file extension
                $filename = $file->getFilename();
                $size = $file->getSize(); // Bytes
                $sizeinMB = round($size / (1000 * 1024), 2);// MB

                if ($sizeinMB <= 2) { // Check file size is <= 2 MB
                    $files_info[] = array(
                        "name" => $filename,
                        "size" => $size,
                        "path" => url($directory . '/' . $filename)
                    );
                }
            }
        }
        return response()->json($files_info);
    }

    public function deleteFile(Request $request)
    {
        $filename = $request->get('filename');
        Document::where('file_name',$filename)->delete();
        $path = public_path() . '/uploads/' . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }
    /*

    public function deleteFile(Request $request)
    {
        $filename = $request->get('filename');
        //ImageUpload::where('filename',$filename)->delete();
        $path = public_path() . '/images/' . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }

    public function uploadImages(Request $request)
    {
        $image = $request->file('file');

        $imageName = $image->getClientOriginalName();
        $image->move(public_path('images'), $imageName);
        $data = Document::create(['file_name' => $imageName, 'title' => "1"]);
        return response()->json(["status" => "success", "data" => $data]);
    }

    public function uploadImages2(Request $request)
    {
        $image = $request->file('file');

        $imageName = $image->getClientOriginalName();
        $image->move(public_path('images'), $imageName);
        $data = Document::create(['file_name' => $imageName, 'title' => "2"]);
        return response()->json(["status" => "success", "data" => $data]);
    }

// --------------------- [ Delete image ] -----------------------------

    public function deleteImage(Request $request)
    {
        $filename = $request->get('filename');

        Document::where('file_name', $filename)->delete();

        $path = public_path() . '/images/' . $filename;

        if (file_exists($path)) {
            unlink($path);
        }

        return $filename;
    }

    */

}
