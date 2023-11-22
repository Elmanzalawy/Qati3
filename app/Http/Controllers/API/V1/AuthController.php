<?php

namespace App\Http\Controllers\API\V1;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends BaseController
{
    /**
     * register
     *
     * @param  Request $request
     * @return Response
     */
    public function register(Request $request): Response
    {
        try{
            $validated = $request->validate([
                'name' => 'required|string|max:25',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|confirmed',
            ]);

            $user = User::where('email', $request->email)->first();

            $validated['password'] = Hash::make($validated['password']);

            event(new Registered($user = User::create($validated)));

            auth()->login($user);

            $token =  $user->createToken('api-v1')->plainTextToken;

            return $this->jsonResponse(1, [
                'token' => $token
            ]);

        }
        catch (ValidationException $e)
        {
            return $this->error('Validation error', $e->errors(), 422);
        }
        catch(\Exception $e)
        {
            return response($e->getMessage(), 400);
        }
    }

    /**
     * login
     *
     * @param  Request $request
     * @return Response
     */
    public function login(Request $request): Response
    {
        try{
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $user = User::where('email', $request->email)->first();

            if (! $user || ! Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            }

            $token = $user->createToken('api-v1')->plainTextToken;

            return $this->jsonResponse(1, [
                'token' => $token,
            ]);
        }
        catch (ValidationException $e)
        {
            return $this->error('Validation error', $e->errors(), 422);
        }
        catch(\Exception $e)
        {
            return response($e->getMessage(), 400);
        }
    }

    /**
     * logout
     *
     * @return Response
     */
    public function logout(): Response
    {
        // Revoke all user tokens
        auth()->user()->tokens()->delete();

        return $this->success(__('Logout successful'));
    }
}
