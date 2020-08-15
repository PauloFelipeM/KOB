<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use App\ServiceType;
use App\Workspace;

class ServiceTypeController extends Controller
{
    protected $rules_create = array(
        'title' => 'required|string|max:150',
        'hourly_amount' => 'required',
        'min_hourly_rate' => 'required',
        'first_span' => 'required',
        'first_span_rate' => 'required',
        'next_span' => 'required',
        'next_span_rate' => 'required',
        'remaining_span_rate' => 'required',  
        'file' => 'required|mimes:jpg,jpeg,png',
    );

    protected $rules_update = array(
        'title' => 'required|string|max:150',
        'hourly_amount' => 'required',
        'min_hourly_rate' => 'required',
        'first_span' => 'required',
        'first_span_rate' => 'required',
        'next_span' => 'required',
        'next_span_rate' => 'required',
        'remaining_span_rate' => 'required',    
        'file' => 'mimes:jpg,jpeg,png',    
    );

    protected function messages(){
        return array(
            'file.required' => __('customvalidation.image_required'),
        );
    }

    public function index()
    {
        $service_types = ServiceType::index();

        return view('service_types.index', array(
            'service_types' => $service_types,
        ));
    }

    public function view($id){
        $service_type = ServiceType::find($id);     
        return view('service_types.view', array(
            'service_type' => $service_type,            
        ));
    }

    public function create(){
        return view('service_types.create');
    }

    public function update($id){

        $service_type = ServiceType::find($id);

        return view('service_types.update', array(
            'service_type' => $service_type,
        ));
    }

    public function store(Request $request, $id = "")
    {        
        if(empty($id)){
            $this->validate(request(), $this->rules_create, $this->messages());
        }else{
            $this->validate(request(), $this->rules_update);
        }
        
        $data = $request->all();
        $file = $request->file('file');
        if($file){
            $extension = $file->getClientOriginalExtension();
            Storage::disk('media')->put($file->getFilename() . '.' . $extension, File::get($file));
            $data['original_filename'] = $file->getClientOriginalName();
            $data['storage_filename'] = $file->getFilename() . '.' . $extension;   
        }                     
        if(!empty($id)){            
            $service_type = ServiceType::find($id);
            if($file) Storage::disk('media')->delete($service_type->storage_filename);
            $service_type->update($data);          
        }else{
            $workspace = Workspace::getCurrentWorkspace();
            $service_type = new ServiceType();            
            $service_type->fill($data);
            $service_type->workspace_id = $workspace->id;
            $service_type->save();
        }
      
        return Redirect::to('service_types');
    }

    public function delete(ServiceType $service_type){
        $service_type->delete();
        Storage::disk('media')->delete($service_type->storage_filename);
        return Redirect::to('service_types');
    }
}
