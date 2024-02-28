<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LeadRequest;
use App\Http\Resources\LeadsCollection;
use App\Http\Resources\LeadsResource;
use App\Models\Leads;
use Illuminate\Http\Request;

class LeadsController extends Controller
{
    public function get(Request $request, Leads $lead = null)
    {
        if ($lead) {
            return new LeadsResource($lead);
        } else {
            $campaigns = Leads::where("details", "like", "%$request->search%")->paginate($request->limit ?: 10);
            return new LeadsCollection($campaigns);
        }
    }

    public function add(LeadRequest $request)
    {
        $create = Leads::create($request->all());

        return response()->json(["message" => "Lead created successfully", "data" => $create], Response::HTTP_CREATED);
    }

    public function update(LeadRequest $request, Leads $lead)
    {
        $lead->update($request->all());

        return response()->json(["message" => "Client updated successfully", "data" => $lead], Response::HTTP_CREATED);
    }

    public function delete(Leads $lead)
    {
        $lead->delete();

        return response()->json(["message" => "Provided client has been deleted successfully", "data" => null],Response::HTTP_NO_CONTENT);
    }
}
