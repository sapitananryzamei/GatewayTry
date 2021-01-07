<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Model\User;
use App\Traits\ApiResponser;
use App\Http\Controllers\Response;

Class UserController extends Controller {
    use ApiResponser;
    private $request;
    public function __construct(Request $request){

    $this->request = $request;
    }

    public function getUsers(){
        $users =  User::all();
        return $this->successResponse($users);
    }

    public function createUser(Request $request)
    {
        $rules = [
            'username' => 'required|max:50',
            'password' => 'required|max:50',
        ];

        $this->validate($request, $rules);

        $user = User::create($request->all());

        return $this->createSuccess($user);
    }

    public function findUser($id)
    {
        $user = User::findOrFail($id);
        return $this->successResponse($user);
    }

    public function updateUser(Request $request, $id)
    {
        $rules = [
            'username' => 'max:20',
            'password' => 'max:20',
        ];

        $this->validate($request, $rules);
        $user = User::findOrFail($id);

        $user->fill($request->all());

        // if no changes happen
        if ($user->isClean()) {
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user->save();
        return $this->updateSuccess($user);
    }

    public function delete($id) {
        $user = User::findOrFail($id);
        $user->delete();
        return $this->deleteSuccess($user);
    }
}

?>