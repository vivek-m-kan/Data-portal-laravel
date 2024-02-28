<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Response;
use App\Http\Requests\ClientRequest;
use App\Http\Resources\ClientCollection;
use App\Http\Resources\ClientResource;
use App\Models\Clients;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function get(Request $request, Clients $client = null)
    {
        if ($client) {
            return new ClientResource($client);
        } else {
            $campaigns = Clients::filter($request)->paginate($request->limit ?: 10);
            return new ClientCollection($campaigns);
        }
    }

    public function add(ClientRequest $request)
    {
        $create = Clients::create($request->all());

        return response()->json(["message" => "Client created successfully", "data" => $create], Response::HTTP_CREATED);
    }

    public function update(ClientRequest $request, Clients $client)
    {
        $client->update($request->all());

        return response()->json(["message" => "Client updated successfully", "data" => $client], Response::HTTP_CREATED);
    }

    public function delete(Clients $client)
    {
        $client->delete();

        return response()->json(["message" => "Provided client has been deleted successfully", "data" => null],Response::HTTP_NO_CONTENT);
    }
}
