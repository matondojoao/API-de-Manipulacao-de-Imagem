<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Http\Requests\StoreAlbumRequest;
use App\Http\Requests\UpdateAlbumRequest;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Album=Album::paginate(10);
        return response()->json(['data'=>$Album],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAlbumRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAlbumRequest $request)
    {
       try {
          $albumData=$request->all();
          //$albumData=$request['user_id']=Auth('api')->user()->id;
          $Album=Album::create($albumData);

          return response()->json(
              ['msg'=>'Album criado com sucesso'],
          200);
       } catch (\Throwable $th) {
        return response()->json(
            ['error'=>$th->getMessage()],
        401);
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $album=Album::findOrFail($id);
        return response()->json(['data'=> $album],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAlbumRequest  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAlbumRequest $request, Album $album)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $album=Album::findOrFail($id)->delete();
        return response()->json(
            ['msg'=>'Album removido com sucesso'],
        200);
    }
}
