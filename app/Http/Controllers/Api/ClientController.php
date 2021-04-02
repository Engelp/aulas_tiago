<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function getClientes(Request $request)
    {
        $data = Client::paginate(50);
        return response()->json($data, 200);
    }

    public function storeClient(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $active         = $request->active && strtolower($request->active) == 'yes' ? true : false;

        $client_data    = [
            'name'   => $request->name,
            'active' => $active,
        ];

        if($request->hasFile('photo') && $request->file('photo')->isValid())
            $client_data['photo'] = $this->putPhoto($request, $request->name) ?? null;

        $client         = Client::create($client_data);
    }

    public function putPhoto(Request $request, string $client_name)
    {
        if($request->hasFile('photo') && $request->file('photo')->isValid())
        {
            $photo      = $request->file('photo');
            $rand_id    = rand(100,12000).time();
            $extension  = $photo->extension();
            $file_name  = \Str::slug($client_name).'_'.$rand_id.'.'.$extension;
            $status     = $request->photo->storeAs('public', $file_name);

            if($status)
                return 'storage/'.$file_name;
            else
                return null;
        }
    }
}
