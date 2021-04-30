<?php

namespace App\Http\Controllers;

use App\Http\Requests\EducationAddRequest;
use App\Http\Requests\ExperienceRequest;
use App\Models\Education;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function  list()
    {
$list=Experience::all();
return view('admin.experience_list',compact('list'));
    }
    public function  addShow(Request $request)
    {
        $id=$request->experienceID;
        $experience=null;
        if(!is_null($id))
        {
            $experience=Experience::find($id);
        }
        return view('admin.experience_add',compact('experience'));
    }
    public function  add(ExperienceRequest $request)
    {
        $status=0;
        $active=0;
        $order=$request->order;
        if(isset($request->status))
        {
            $status=1;
        }
        if(isset($request->active))
        {
            $active=1;
        }
        if(isset($request->experienceID))
        {
            $id=$request->experienceID;
            Experience::where('id',$id)->update([
                "date"=>$request->date,
                "task_name"=>$request->task_name,
                "company_name"=>$request->company_name,
                "description"=>$request->description,
                "status"=>$status,
                "active"=>$active,
                "order"=>$order ? $order :999
            ]);
            alert()->success('Başarılı','ID ye sahip Deneyim Bilgisi Güncellendi.')->showConfirmButton('Tamam', '#3085d6')->persistent(true,true);
            return redirect()->route('admin.experience.list');
        }
        else{
            Experience::create([
                "date"=>$request->date,
                "task_name"=>$request->task_name,
                "company_name"=>$request->company_name,
                "description"=>$request->description,
                "status"=>$status,
                "active"=>$active,
                "order"=>$order ? $order :999
            ]);

            alert()->success('Başarılı','Deneyim Bilgisi Eklendi.')->showConfirmButton('Tamam', '#3085d6')->persistent(true,true);
            return redirect()->route('admin.experience.list');

        }
    }
    public function changeStatus(Request $request)
    {
        $id=$request->experienceID;
        $newStatus=null;
        $findExperience=Experience::find($id);
        $status=$findExperience->status;

        if ($status)
        {
            $status=0;
            $newStatus="pasif";
        }
        else
        {
            $status=1;
            $newStatus="aktif";
        }
        $findExperience->status=$status;
        $findExperience->save();

        return response()->json([
            'newStatus'=>$newStatus,
            'experienceID'=>$id,
            'status'=>$status
        ],200);

    }
    public function activeStatus(Request $request)
    {
        $id=$request->experienceID;
        $newActive=null;
        $findExperience=Experience::find($id);
        $active=$findExperience->active;

        if ($active)
        {
            $active=0;
            $newActive="pasif";
        }
        else
        {
            $active=1;
            $newActive="aktif";
        }
        $findExperience->active=$active;
        $findExperience->save();

        return response()->json([
            'newActive'=>$newActive,
            'experienceID'=>$id,
            'active'=>$active
        ],200);

    }

    public function  delete(Request  $request)
    {
        $id=$request->experienceID;
        Experience::where('id',$id)->delete();
        return response()->json([],200);
    }


}
