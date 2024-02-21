<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

class UserRepository implements UserRepositoryInterface
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    
    public function get(string $order = 'id', string $sort = 'ASC')
    {
        try {
            $users = $this->user->orderBy($order, $sort)->get();
            return $users;
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());   
        }
    }

    public function paginate(int $perPage = 10, string $order = 'id', string $sort = 'AS')
    {
        try {
            $users = $this->user->orderBy($order, $sort)->paginate($perPage);
            return $users;
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
            
        }
    }

    public function create(Request $request)
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
            throw new InvalidArgumentException($exception->getMessage());
            
        }
    }

    public function find(int $id)
    {
        try {
            $user = $this->user->findOrFail($id);
            return $user;
        } catch (ModelNotFoundException $exception) {
            throw new ModelNotFoundException($exception->getMessage());
        }
    }

    public function update(Request $request, int $id)
    {
        try {
            $user = $this->user->findOrFail($id);
            $user->username = $request->username;
            $user->last_name = $request->last_name;
            $user->first_name = $request->first_name;
            $user->password = Hash::make($request->password);
            $user->role = $request->role;
            $user->save();

            return $user;
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
            
        }
    }

    public function delete(int $id)
    {
        try {
            $user = $this->user->findOrFail($id);
            $user->delete();

            return $user;
        } catch (ModelNotFoundException $exception) {
            throw new ModelNotFoundException($exception->getMessage());
        }
    }
}
