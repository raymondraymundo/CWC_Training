<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

class UserRepository implements UserRepositoryInterface
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }
    
    public function get(string $order = 'id', string $sort = 'ASC'): Collection
    {
        try {
            $users = $this->model->orderBy($order, $sort)->get();
            return $users;
        } catch (QueryException $exception) {
            Log::error(Route::currentRouteName().': '.$exception->getMessage());
            throw new InvalidArgumentException($exception->getMessage());   
        }
    }

    public function paginate(int $perPage = 10, string $order = 'id', string $sort = 'ASC'): Jsonable
    {
        try {
            $users = $this->model->orderBy($order, $sort)->paginate($perPage);
            return $users;
        } catch (QueryException $exception) {
            Log::error(Route::currentRouteName().': '.$exception->getMessage());
            throw new InvalidArgumentException($exception->getMessage());
            
        }
    }

    public function create(Request $request): User
    {
        try {
            $user = new User;
            $user->username = $request->username;
            $user->last_name = $request->last_name;
            $user->first_name = $request->first_name;
            $user->password = Hash::make($request->password);
            $user->role = $request->role;
            $user->save();

            return $user;
        } catch (QueryException $exception) {
            Log::error(Route::currentRouteName().': '.$exception->getMessage());
            throw new InvalidArgumentException($exception->getMessage());
            
        }
    }

    public function find(int $id): User
    {
        try {
            $user = $this->model->findOrFail($id);
            return $user;
        } catch (ModelNotFoundException $exception) {
            Log::error(Route::currentRouteName().': '.$exception->getMessage());
            throw new ModelNotFoundException($exception->getMessage());
        }
    }

    public function update(Request $request, int $id): User
    {
        try {
            $user = $this->model->findOrFail($id);
            $user->username = $request->username;
            $user->last_name = $request->last_name;
            $user->first_name = $request->first_name;
            $user->password = Hash::make($request->password);
            $user->role = $request->role;
            $user->save();

            return $user;
        } catch (QueryException $exception) {
            Log::error(Route::currentRouteName().': '.$exception->getMessage());
            throw new InvalidArgumentException($exception->getMessage());
            
        }
    }

    public function delete(int $id): User
    {
        try {
            $user = $this->model->findOrFail($id);
            $user->delete();

            return $user;
        } catch (ModelNotFoundException $exception) {
            Log::error(Route::currentRouteName().': '.$exception->getMessage());
            throw new ModelNotFoundException($exception->getMessage());
        }
    }
}
