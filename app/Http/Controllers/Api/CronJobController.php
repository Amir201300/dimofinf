<?php


namespace App\Http\Controllers\Api;


use App\Interfaces\IPostRepo;
use App\Interfaces\IUserRepo;
use App\Mail\DailyReport;
use Mail;

class CronJobController
{
    use \App\Traits\ApiResponseTrait;

    private $postRepo;
    private $userRepo;

    public function __construct(IPostRepo $postRepo,IUserRepo $userRepo)
    {
        $this->userRepo = $userRepo;
        $this->postRepo = $postRepo;
    }

    /***
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function daily_report(){
        $posts=$this->postRepo->getDailyPosts();
        $users=$this->userRepo->getDailyUsers();

        // put configuration
        Mail::to('ahmedamirr56@gmail.com')->send(new DailyReport($users,$posts));
        return $this->apiResponseMessage(1,'success');
    }

}
