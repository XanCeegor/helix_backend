<?php

namespace App\Http\Controllers;

use App\File;
use App\Upload;
use Illuminate\Http\Request;

class FileController extends Controller
{

    public function downloadFile($id)
    {
        $file = File::findOrFail($id);
        return response()->download(storage_path('app/files/'.$file->name));
    }

    public function downloadZIP($id){

        $files = Upload::where('share_id', $id)->first()->files;
        $zip_file = $id.'.zip';
        $zip = new \ZipArchive();
        $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        foreach($files as $file){
            $zip->addFile((storage_path('app/files/'.$file->name)), $file->originalName);
        }
        $zip->close();
        return response()->download($zip_file);
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
