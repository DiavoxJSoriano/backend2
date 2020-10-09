<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api')->except(['index', 'show', 'store', 'update', 'destroy', 'destroyMany']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            // Without this initial where refactor, the search filter doesn't work.
            $user = User::where('id', '>', 0);

            // Filtering name from search keyword
            if ($request->has('search_name')) {
                $user->where('name', 'like', '%' . $request->search_name . '%');
            }

            $users = $user->get();
            return UserResource::collection($users);
        } catch (Exception $ex) {
            Log::error('Users - index', [$ex->getMessage()]);
            return response()->json(['status' => $ex->getMessage()], 403);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            if (!$request->has('email')) {
                Log::warning('Email is missing.');
                return response()->json(['status' => 'Email is missing.'], 403);
            }

            if (!$request->has('password')) {
                Log::warning('Password is missing.');
                return response()->json(['status' => 'Password is missing.'], 403);
            }

            if (!$request->has('username')) {
                Log::warning('Username is missing.');
                return response()->json(['status' => 'Username is missing.'], 403);
            }

            $first = (string) $request->name_first;
            $last = (string) $request->name_last;
            $name = $first . " " . $last;

            // Double check Email input if it is existing.
            $result = User::where('email', (string) $request->email)->orWhere('username', (string) $request->username)->first();
            if ($result) return response()->json(['status' => 'Email/Username already exists.'], 403);

            $user = User::create([
                'name' => $name,
                'email' => (string) $request->email,
                'password' => bcrypt($request->password),
                'name_first' => ucfirst($first),
                'name_last' => ucfirst($last),
                'address' => (string) $request->address,
                'username' => (string) $request->username,
                'postcode' => (string) $request->postcode,
                'contact_phone' => (string) $request->contact_phone,
            ]);

            return new UserResource($user);
        } catch (Exception $ex) {
            Log::error('adding user.', [$ex->getMessage()]);
            return response()->json(['status' => $ex->getMessage()], 500);
        } catch (ModelNotFoundException $ex) {
            Log::error('adding user.', [$ex->getMessage()]);
            return response()->json(['status' => $ex->getMessage()], 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $result = User::findOrFail($id);
            if ($result) {
                return new UserResource($result);
            } else {
                return response()->json(['status' => "Invalid argument."], 404);
            }
        } catch (Exception $ex) {
            Log::error('retrieving a user.', [$ex->getMessage()]);
            return response()->json(['status' => $ex->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        try {

            $found = User::where('email', $request->email)->where('id', '!=', $user->id)->first();

            if (!$found) {
                $user->update($request->only([
                    'name',
                    'email',
                    'password',
                    'name_first',
                    'name_last',
                    'address',
                    'postcode',
                    'contact_phone',
                ]));

                return new UserResource($user);
            } else {
                Log::warning('email exists.', [$found]);
                return response()->json(['status' => 'Email already in use.'], 403);
            }
        } catch (Exception $ex) {
            Log::error('updating user.', [$ex->getMessage()]);
            return response()->json(['status' => $ex->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            if ($user) {
                $user->delete($id);
                return response()->json(['status' => "Successfully deleted!"], 200);
            } else {
                Log::error('Unable to delete. Record not found.', [$id]);
                return response()->json(['status' => 'Unable to delete. Record not found.'], 404);
            }
        } catch (Exception $ex) {
            Log::error('deleting a user.', [$ex->getMessage()]);
            return response()->json(['status' => $ex->getMessage()], 500);
        }
    }

    /**
     * Remove multiple specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyMany(Request $request)
    {
        try {
            //$json = '{ "ids" : ["2", "4", "6"] }';
            //$test = ["2", "4", "6"];
            User::whereIn('id', $request->ids)->delete();
            return response()->json(['status' => "Successfully deleted records!"], 200);
        } catch (Exception $ex) {
            Log::error('deleting multiple user.', [$ex->getMessage()]);
            return response()->json(['status' => $ex->getMessage()], 500);
        }
    }
}
