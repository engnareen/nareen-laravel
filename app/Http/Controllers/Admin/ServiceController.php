<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use DataTables;

class ServiceController extends Controller
{
    public function index()
    {
        return view('services.services-list');
    }

    public function addService(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'service_name' => 'required|unique:services',
            'details' => 'required',
            'service_icon' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $service = new Service();
            $service->service_name = $request->service_name;
            $service->details = $request->details;
            $service->service_icon = $request->service_icon;
            $query = $service->save();

            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'New Service has been successfully saved']);
            }
        }
    }

    // GET ALL SERVICES
    public function getServicesList(Request $request)
    {
        $services = Service::all();
        return DataTables::of($services)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="btn-group">
                    <a style="border:none; color:orange" class="fas fa-edit" data-id="' . $row['id'] . '" id="editServiceBtn"></a>
                    <a style="border:none; color:red;" class="fas fa-trash" data-id="' . $row['id'] . '" id="deleteServiceBtn"></a>
            </div>';
            })
            ->addColumn('checkbox', function ($row) {
                return '<input type="checkbox" name="service_checkbox" data-id="' . $row['id'] . '"><label></label>';
            })

            ->rawColumns(['actions', 'checkbox'])
            ->make(true);
    }

    //GET SERVICE DETAILS
    public function getServiceDetails(Request $request)
    {
        $service_id = $request->service_id;
        $serviceDetails = Service::find($service_id);
        return response()->json(['details' => $serviceDetails]);
    }

    //UPDATE SERVICE DETAILS
    public function updateServiceDetails(Request $request)
    {
        $service_id = $request->cid;

        $validator = \Validator::make($request->all(), [
            'service_name' => 'required|unique:services,service_name,' . $service_id,
            'details' => 'required',
            'service_icon' => 'required',

        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            $service = Service::find($service_id);
            $service->service_name = $request->service_name;
            $service->details = $request->details;
            $service->service_icon = $request->service_icon;
            $query = $service->save();

            if ($query) {
                return response()->json(['code' => 1, 'msg' => 'Service Details have Been updated']);
            } else {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            }
        }
    }

    // DELETE SERVICE RECORD
    public function deleteService(Request $request)
    {
        $service_id = $request->service_id;
        $query = Service::find($service_id)->delete();

        if ($query) {
            return response()->json(['code' => 1, 'msg' => 'Service has been deleted from database']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
        }
    }


    public function deleteSelectedServices(Request $request)
    {
        $service_ids = $request->services_ids;
        Service::whereIn('id', $service_ids)->delete();
        return response()->json(['code' => 1, 'msg' => 'Services have been deleted from database']);
    }
}
