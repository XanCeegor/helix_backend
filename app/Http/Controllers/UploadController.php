<?php

namespace App\Http\Controllers;

use App\File;
use App\User;
use App\Upload;
use Illuminate\Http\Request;
use App\Http\Resources\File as FileResource;

class UploadController extends Controller
{
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
    public function store(Request $request){
        if(count($request->file('files'))){
            $shareId = (substr(md5(rand()), 0, 7));
            try{
                $user = User::where('name', 'Anon')->first();   //save file anonymously
                $upload = $user->uploads()->create(['share_id' => $shareId, 'visibility' => 'public']);
                foreach($request->file('files') as $file){
                    $path = $file->store('files');
                    $upload->files()->create(['name' => basename($path), 'originalName' => $file->getClientOriginalName(), 'size' => $file->getClientSize(),
                    'path' => $path, 'visibility' => 'public', 'type' => $file->getClientOriginalExtension()]);
                }
                return response()->json([
                    "success" => $shareId
                ]);
            }
            catch(\Exception $e){
                return response()->json([
                    "error" => $e
                ]);
            }
        }
    }

    public function show($id)
    {
        $files = Upload::where('share_id' ,$id)->first()->files;
        return new FileResource($files);
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
