<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Http\Requests\StoreAlbumRequest;
use App\Http\Requests\UpdateAlbumRequest;
use App\Http\Resources\V1\AlbumResource;

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
        return AlbumResource::collection(Album::paginate(10));
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
          $Album=Album::create($albumData);

          return response(['msg'=>'Album criado com sucesso'],200);

       } catch (\Throwable $th) {
           return response(['error'=>$th->getMessage()],401);
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show($album)
    {
      return new AlbumResource(Album::findOrFail($album));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAlbumRequest  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAlbumRequest $request,Album $album)
    {
        try {
            $album->update($request->all());
            return new AlbumResource($album);

         } catch (\Throwable $th) {
            return response(['error'=>$th->getMessage()],401);
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album)
    {
        try {
            $album->delete();
            return response('Album removido com sucesso',204);

         } catch (\Throwable $th) {
            return response(['error'=>$th->getMessage()],401);
         }
    }
}
