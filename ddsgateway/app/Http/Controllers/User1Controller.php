<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\Services\User1Service;

Class User1Controller extends Controller {
    use ApiResponser;
    /**
     * The service to consume the User1 Microservice
     * @var User1Service
     */
    public $user1Service;
    /**
     * Create a new controller instance
     * @return void
     */
    public function __construct(User1Service $user1Service)
    {
        $this->user1Service = $user1Service;
    }

    public function getUsers()
    {
        return $this->successResponse($this->user1Service->getUsers1()); 
    }

    public function createUser(Request $request)
    {
        return $this->successResponse($this->user1Service->createUsers1($request->all()));
    }

    public function findUser($id){
        return $this->successResponse($this->user1Service->findUsers1($id));
    }

    public function updateUser(Request $request, $id)
    {
        return $this->successResponse($this->user1Service->updateUsers1($request->all(),$id));
    }

    public function deleteUser($id)
    {
        return $this->successResponse($this->user1Service->deleteUsers1($id));
    }



}

?>