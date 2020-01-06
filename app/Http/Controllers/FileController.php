<?php

namespace App\Http\Controllers;

use Zip;
use FileVault;
use Str;
use App\File;
use App\Upload;
use App\Jobs\DeleteTempFiles;
use Illuminate\Http\Request;

class FileController extends Controller
{

    public function downloadFile($id)
    {
        $file = File::findOrFail($id);
        //decrypt file and download
        return response()->streamDownload(function () use ($file) {
            FileVault::streamDecrypt('files/' . $file->name . '.enc');
        }, Str::replaceLast('.enc', '', $file->name));
    }

    public function downloadZIP($id)
    {
        $files = Upload::where('share_id', $id)->first()->files;
        $zip_file = Zip::create("myfile.zip");
        foreach ($files as $file) {
            if (file_exists(storage_path('app/' . $file->path . '.enc'))) {
                FileVault::decryptCopy($file->path . '.enc');
                $zip_file->add(storage_path('app/' . $file->path));
            } else {
                return 'File: ' . $file->path . ' not found!';
            }
        }
        //Clean up temp decrypted files shortly after download
        DeleteTempFiles::dispatch($files)->delay(now()->addMinutes(5));
        return $zip_file;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // if(count($request->file('files'))){
        //     foreach($request->file('files') as $file){
        //         $file->store('files');
        //     }
        // }
        // $upload = User::where('name', 'Xan')->first()->uploads()->create(['visibility' => 'visible', 'toDelete' => false]);

        // $test = json_encode($upload);
        // return response()->json([
        //     $test
        // ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        //
    }
}
