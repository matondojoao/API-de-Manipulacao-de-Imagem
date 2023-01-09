<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\ImageManipulation;
use App\Http\Requests\StoreImageManipulationRequest;
use App\Http\Requests\UpdateImageManipulationRequest;
use App\Models\Album;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


class ImageManipulationController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreImageManipulationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function resize(StoreImageManipulationRequest $request)
    {
        $all=$request->all();

        $image=$all['image'];

        unset($all['image']);

        $data=[
            'name',
            'path'=>ImageManipulation::TYPE_RESIZE,
            'data'=>json_encode($all),
            'user_id'=>null,
        ];
        if(isset($all['album_id'])){

            $data['album_id']=$all['album_id'];
        }

        $dir='images/'.Str::random().'/';
        $absolutePath=public_path($dir);

        File::makeDirectory($absolutePath);

        if($image instanceof UploadedFile){
            $data['name']=$image->getClientOriginalName();
            $filaname=pathinfo($data['name'], PATHINFO_FILENAME);
            $extension=$image->getClientOriginalExtension();

            $image->move($absolutePath);

        }
        else{

        }
    }
    public function porAlbum(Album $album){

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ImageManipulation  $imageManipulation
     * @return \Illuminate\Http\Response
     */
    public function show(ImageManipulation $imageManipulation)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ImageManipulation  $imageManipulation
     * @return \Illuminate\Http\Response
     */
    public function destroy(ImageManipulation $imageManipulation)
    {
        //
    }
}
