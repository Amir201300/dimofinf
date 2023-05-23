<?php


namespace App\Http\Controllers\Admin;

use App\Interfaces\IUserRepo;
use App\Validations\UserValidation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Yajra\DataTables\DataTables;
use Auth, File;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    use \App\Traits\ApiResponseTrait;

    public function __construct(IUserRepo $userRepo,UserValidation $userValidation)
    {
        $this->userRepo = $userRepo;
        $this->userValidation = $userValidation;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $title='Users';
        return view('Admin.User.index',compact('title'));
    }

    /***
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function allData(Request $request)
    {
        $data = $this->userRepo->getUsers($request);
        return Datatables::of($data)->addColumn('action', function ($data) {
            $options = '<td class="sorting_1"><button  class="btn btn-info waves-effect btn-circle waves-light" onclick="editFunction(' . $data->id . ')" type="button" ><i class="fa fa-spinner fa-spin" id="loadEdit_' . $data->id . '" style="display:none"></i><i class="sl-icon-wrench"></i></button>';
            $options .= ' <button type="button" onclick="deleteFunction(' . $data->id . ',1)" class="btn btn-dribbble waves-effect btn-circle waves-light"><i class="sl-icon-trash"></i> </button></td>';
            return $options;
        })->editColumn('status', function ($data) {
            if ($data->status == 1)
                $status = '<button class="btn waves-effect waves-light btn-rounded btn-success statusBut"">active</button>';
            else
                $status = '<button class="btn waves-effect waves-light btn-rounded btn-danger statusBut">un active</button>';
            return $status;
        })->rawColumns(['action' =>'action','status'=>'status'])->make(true);
    }


    /***
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function single (Request $request)
    {
        $response=$this->userRepo->getUserById($request->id);
        if($response->operationType==ERROR)
            return $this->apiResponseMessage(0,$response->error,400);
        return $this->apiResponseData($response->data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validateUser=$this->userValidation->validate($request);
        if($validateUser->operationType==ERROR)
            return $this->apiResponseMessage(0,$validateUser->error,200);
        $this->userRepo->create($request);
        return $this->apiResponseMessage(1,'User Added Successfully',200);
    }

    /***
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $response=$this->userRepo->getUserById($request->id);
        if($response->operationType==ERROR)
            return $this->apiResponseMessage(0,$response->error);
        $user=$response->data;
        $request['user_id']=$user->id;
        $validateUser=$this->userValidation->validate($request);
        if($validateUser->operationType==ERROR)
            return $this->apiResponseMessage(0,$validateUser->error,200);
        $this->userRepo->update($request,$user);
        return $this->apiResponseMessage(1,'User Updated Successfully',200);
    }

    /***
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $response=$this->userRepo->getUserById($request->id);
        if($response->operationType==ERROR)
            return $this->apiResponseMessage(0,$response->error,400);
        $this->userRepo->delete($response->data);
        return response()->json(['errors' => false]);
    }

}
