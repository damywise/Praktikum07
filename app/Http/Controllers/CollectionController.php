<?php

namespace App\Http\Controllers;

use App\Http\Resources\Collection as CollectionResource;
use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CollectionController extends BaseController
{

    public function index()
    {
        $collections = Collection::all();
        return $this->sendResponse(CollectionResource::collection($collections), 'Posts fetched. ');
    }
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make(
            $input,
            [
                'namaKoleksi' => 'required',
                'jenisKoleksi' => 'required',
                'jumlahAwal' => 'required',
                'jumlahSisa' => 'required',
                'jumlahKeluar' => 'required'
            ]
        );
        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }
        $collection = Collection::create($input);
        return $this->sendResponse(new CollectionResource($collection), 'Post created.');
    }
    public function show($id)
    {
        $collection = Collection::find($id);
        if (is_null($collection)) {
            return $this->sendError('Post does not exist.');
        }
        return $this->sendResponse(new CollectionResource($collection), 'Post fetched.');
    }
    public function update(Request $request, Collection $collection)
    {
        $input = $request->all();
        $validator = Validator::make(
            $input,
            [
                'namaKoleksi' => 'required',
                'jenisKoleksi' => 'required',
                'jumlahAwal' => 'required',
                'jumlahSisa' => 'required',
                'jumlahKeluar' => 'required'
            ]
        );

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }
        $collection->namaKoleksi = $input['namaKoleksi'];
        $collection->jenisKoleksi = $input['jenisKoleksi'];
        $collection->jumlahAwal = $input['jumlahAwal'];
        $collection->jumlahSisa = $input['jumlahSisa'];
        $collection->jumlahKeluar = $input['jumlahKeluar'];
        $collection->save();
        return $this->sendResponse(new CollectionResource($collection), 'Post updated.');
    }
    public function destroy(Collection $collection)
    {
        $collection->delete();
        return $this->sendResponse([], 'Post deleted. ');
    }
}
