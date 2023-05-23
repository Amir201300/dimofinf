<div class="card-group">
    <!-- Card -->
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="m-r-10">
                                    <span class="btn btn-circle btn-lg bg-danger">
                                        <i class="icon-Add-UserStar text-white"></i>
                                    </span>
                </div>
                <div>
                    users
                </div>
                <div class="ml-auto">
                    <h2 class="m-b-0 font-light">{{\App\Models\User::count()}}</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Card -->
    <!-- Card -->
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="m-r-10">
                                    <span class="btn btn-circle btn-lg btn-info">
                                        <i class=" icon-Project text-white"></i>
                                    </span>
                </div>
                <div>
                    Posts

                </div>
                <div class="ml-auto">
                    <h2 class="m-b-0 font-light">{{\App\Models\Post::count()}}</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Card -->
    <!-- Card -->
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="m-r-10">
                                    <span class="btn btn-circle btn-lg bg-success">
                                        <i class="icon-Daylight text-white"></i>
                                    </span>
                </div>
                <div>
                    day posts

                </div>
                <div class="ml-auto">
                    <h2 class="m-b-0 font-light">{{\App\Models\Post::whereDay('created_at',now())->count()}}</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Card -->
    <!-- Card -->
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="m-r-10">
                                    <span class="btn btn-circle btn-lg bg-warning">
                                        <i class=" icon-Five-FingersDrag2 text-white"></i>
                                    </span>
                </div>
                <div>
                    month posts

                </div>
                <div class="ml-auto">
                    <h2 class="m-b-0 font-light">{{\App\Models\Post::whereMonth('created_at',now())->count()}}</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Card -->
    <!-- Column -->


</div>
