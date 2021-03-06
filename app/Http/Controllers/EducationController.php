<?php

namespace App\Http\Controllers;

use App\Http\Requests\EducationAddRequest;
use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
   public function  list()
   {
       $list=Education::all();
       return view('admin.education_list',compact('list'));
   }
  /* public function changeStatus(Request $request)
{
$id=$request->educationID;
$newStatus=null;
$findEducation=Education::find($id);
$status=$findEducation->status;
if($status)
{
    $status=0;
    $newStatus="Pasif";
}
else{
    $status=1;
    $newStatus="Aktif";
}
$findEducation->status->$status;
$findEducation->save();
return response()->json([
    'newStatus'=>$newStatus,
    'educationID'=>$id,
    'status'=>$status
]);
}*/
    public function changeStatus(Request $request)
    {
        $id=$request->educationID;
        $newStatus=null;
        $findEducation=Education::find($id);
        $status=$findEducation->status;

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
        $findEducation->status=$status;
        $findEducation->save();

        return response()->json([
            'newStatus'=>$newStatus,
            'educationID'=>$id,
            'status'=>$status
        ],200);

    }

    public function  addShow(Request $request)
    {
        $id=$request->educationID;
        $education=null;
        if(!is_null($id))
        {
         $education=Education::find($id);
        }
        return view('admin.education_add',compact('education'));
    }
    public function  add(EducationAddRequest $request)
    {
        $status=0;
        $order=$request->order;
        if(isset($request->status))
        {
            $status=1;
        }
        if(isset($request->educationID))
        {
            $id=$request->educationID;
            Education::where('id',$id)->update([
                "education_date"=>$request->education_date,
                "university_name"=>$request->university_name,
                "university_branch"=>$request->university_branch,
                "description"=>$request->description,
                "status"=>$status,
                "order"=>$order ? $order :999
]);
            alert()->success('Ba??ar??l??', $id. 'ID ye sahip E??itim Bilgisi G??ncellendi.')->showConfirmButton('Tamam', '#3085d6')->persistent(true,true);
            return redirect()->route('admin.education.list');
        }
        else{
            Education::create([
                "education_date"=>$request->education_date,
                "university_name"=>$request->university_name,
                "university_branch"=>$request->university_branch,
                "description"=>$request->description,
                "status"=>$status,
                "order"=>$order ? $order :999
            ]);

            alert()->success('Ba??ar??l??','E??itim Bilgisi Eklendi.')->showConfirmButton('Tamam', '#3085d6')->persistent(true,true);
            return redirect()->route('admin.education.list');

        }
        }



    public function  delete(Request  $request)
    {
        $id=$request->educationID;
        Education::where('id',$id)->delete();
        return response()->json([],200);
    }
}
