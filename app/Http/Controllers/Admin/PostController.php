<?php


namespace App\Http\Controllers\Admin;

use App\Interfaces\IPostRepo;
use App\Interfaces\IUserRepo;
use App\Validations\PostValidation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Yajra\DataTables\DataTables;
use Auth, File;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    use \App\Traits\ApiResponseTrait;

    private $postRepo;
    private $postValidation;
    private $userRepo;

    public function __construct(IPostRepo $postRepo,PostValidation $postValidation,IUserRepo $userRepo)
    {
        $this->userRepo = $userRepo;
        $this->postRepo = $postRepo;
        $this->postValidation = $postValidation;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $title='Posts';
        $users=$this->userRepo->getUsers($request);
        return view('Admin.Post.index',compact('title','users'));
    }

    /***
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function allData(Request $request)
    {
        $request['not_paginate']=1;
        $data = $this->postRepo->getPosts($request);
        return Datatables::of($data)->addColumn('action', function ($data) {
            $options = '<td class="sorting_1"><button  class="btn btn-info waves-effect btn-circle waves-light" onclick="editFunction(' . $data->id . ')" type="button" ><i class="fa fa-spinner fa-spin" id="loadEdit_' . $data->id . '" style="display:none"></i><i class="sl-icon-wrench"></i></button>';
            $options .= ' <button type="button" onclick="deleteFunction(' . $data->id . ',1)" class="btn btn-dribbble waves-effect btn-circle waves-light"><i class="sl-icon-trash"></i> </button></td>';
            return $options;
        })->editColumn('description', function ($data) {
            return substr($data->description,0,50);
        })->editColumn('user_id', function ($data) {
            return $data->user ? $data->user->username : '';
        })->rawColumns(['action' =>'action'])->make(true);
    }


    /***
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function single (Request $request)
    {
        $response=$this->postRepo->getPostById($request->id);
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
        $validatePost=$this->postValidation->validate($request);
        if($validatePost->operationType==ERROR)
            return $this->apiResponseMessage(0,$validatePost->error,200);
        $this->postRepo->create($request);
        return $this->apiResponseMessage(1,'Post Added Successfully',200);
    }

    /***
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $response=$this->postRepo->getPostById($request->id);
        if($response->operationType==ERROR)
            return $this->apiResponseMessage(0,$response->error,400);
        $Post=$response->data;
        $validatePost=$this->postValidation->validate($request);
        if($validatePost->operationType==ERROR)
            return $this->apiResponseMessage(0,$validatePost->error,400);
        $this->postRepo->update($request,$Post);
        return $this->apiResponseMessage(1,'Post Updated Successfully',200);
    }

    /***
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $response=$this->postRepo->getPostById($request->id);
        if($response->operationType==ERROR)
            return $this->apiResponseMessage(0,$response->error,400);
        $this->postRepo->delete($response->data);
        return response()->json(['errors' => false]);
    }

}
