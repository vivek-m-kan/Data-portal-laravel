<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CampaignRequest;
use App\Http\Resources\CampaignCollection;
use App\Http\Resources\CampaignResource;
use App\Models\Campaigns;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CampaignController extends Controller
{
    public function get(Request $request, Campaigns $campaign = null)
    {
        if ($campaign) {
            return new CampaignResource($campaign);
        } else {
            $campaigns = Campaigns::filter($request)->paginate($request->limit ?: 10);
            return new CampaignCollection($campaigns);
        }
    }

    public function add(CampaignRequest $request)
    {
        $create = Campaigns::create($request->all());

        return response()->json(["message" => "Campaign created successfully", "data" => $create], Response::HTTP_CREATED);
    }

    public function update(CampaignRequest $request, Campaigns $campaign)
    {
        $campaign->update($request->all());

        return response()->json(["message" => "Campaign updated successfully", "data" => $campaign], Response::HTTP_CREATED);
    }

    public function delete(Campaigns $campaign)
    {
        $campaign->delete();

        return response()->json(["message" => "Provided campaign has been deleted successfully", "data" => null], Response::HTTP_NO_CONTENT);
    }

    public function bulkDelete(Request $request)
    {
        $campaigns = Campaigns::whereIn('uuid', $request->all())->pluck('uuid');
        if(!empty($campaigns)) {
            Campaigns::destroy($campaigns);
            return response()->json(["message" => "Provided campaign has been deleted successfully", "data" =>[]], Response::HTTP_NO_CONTENT);
        } else{
            return response()->json(["message" => "Provided campaigns are invalid please select the actual", "data" => null], Response::HTTP_BAD_REQUEST);
        }

    }
}
