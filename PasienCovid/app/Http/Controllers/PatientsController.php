<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientsController extends Controller
{

    //method index - get all resources
    public function index()
        {
         // menggunakan model patient untuk select data
            $patients = Patient::all();

            //pengecekan data patient apakah terdaftar atau tidak
            if (sizeof($patients) != 0){
                $data = [
                    'message' => 'Get all resource',
                    'data' => $patients
                ];
        
                /* menggunakan respons json laravel
                otomatis set header content type json
                otomatis mengubah data array ke JSON
                 mengatur status kode */
                return response()->json($data, 200);
            } else {
                $data = ['massage' => 'Data is empty'];
                return response()->json($data, 200);
            }
        }

    //method store - add resources
    public function store(Request $request)
    {
            # membuat validasi
            $validatedData = $request->validate([
            # kolom => rules|rules
            'name' => 'string|required',
            'phone' => 'string|required',
            'address' => 'required',
            'status' => 'string|required',
            'in_date_at' => 'date|required',
            'out_date_at' => 'date|required'
            ]);

        //menggunakan Patient untuk insert data
        $patients = Patient::create($validatedData);

        $data = [
            'message' => 'Resource is added successfully',
            'data' => $patients
        ];

        //mengembalikan data (json) status code 201
        return response()->json($data, 201);
    }

    //method show - get single resources using id
    public function show($id)
    {
        // cari id patient yang ingin didapatkan
        $patients = Patient::find($id);

        if($patients){
            $data = [
                "message" => "Get Detail Resource",
                'data' => $patients
            ];
            // mengembalikan data json dengan status kode 200
            return response()->json($data, 200);
        }else{
            $data = [
                "message" => "Resource not found"
            ];
            
            // mengembalikan data json dengan status kode 404
            return response()->json($data, 404);
        }
    }

    //method update - edit resources using id
    public function update(Request $request, $id)
    {
        # cari data patient yg ingin diupdate
        $patients = Patient::find($id);

        if ($patients) {
            # mendapatkan data request
            $input = [
                'name' => $request->name ?? $patients->name,
                'phone' => $request->phone ?? $patients->phone,
                'address' => $request->address ?? $patients->address,
                'status' => $request->status ?? $patients->status,
                'in_date_at' => $request->in_date_at ?? $patients->in_date_at,
                'out_date_at' => $request->out_date_at ?? $patients->out_date_at
                
            ];

            # mengupdate data
            $patients->update($input);

            $data = [
                'message' => 'Resource is update successfully',
                'data' => $patients
            ];

            # mengirimkan respon json dgn status code 200
            return response()->json($data, 200);
            } else {
            $data = [
                'message' => 'Resource not found'
            ];

            # mengembalikan data json status code 404
            return response()->json($data, 404);
            }
    }

    //method destroy - delete resources using id
    public function destroy($id)
    {
        # cari data patient yg ingin dihapus
        $patients = Patient::find($id);

        if ($patients) {
            # hapus data patient
            $patients->delete();

            $data = [
                'message' => 'Resource is delete successfully',
            ];

            # mengembalikan data json status code 200
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Resource not found',
            ];

            # mengembalikan data json status code 404
            return response()->json($data, 404);
        }
    }

    //method search - search resources by name
    public function search($name)
    {
        //mencari resource dengan nama yang ada
        $patients = Patient::where('name', 'like',"%{$name}%")->get();

        if (sizeof($patients) != 0){
            $data = [
                'message' => 'Get searched resource',
                'data' => $patients
            ];

            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Resource not found'
            ];

            # mengembalikan data json status code 404
            return response()->json($data, 404);
        }
    }

    //positive - get all resources with positive status
    public function positive()
    {
        $patients = Patient::where('status',"positive")->get();

            $data = [
                'message' => 'Get positive resource',
                'total' => count($patients),
                'data' => $patients
            ];
            return response()->json($data, 200);
    }

    //recovered - get all resources with recovered status
    public function recovered()
    {
        $patients = Patient::where('status',"recovered")->get();

            $data = [
                'message' => 'Get recovered resource',
                'total' => count($patients),
                'data' => $patients
            ];
            return response()->json($data, 200);
    }


    //dead - get all resources with dead status
    public function dead()
    {
        $patients = Patient::where('status',"dead")->get();

            $data = [
                'message' => 'Get dead resource',
                'total' => count($patients),
                'data' => $patients
            ];
            return response()->json($data, 200);
    }
}