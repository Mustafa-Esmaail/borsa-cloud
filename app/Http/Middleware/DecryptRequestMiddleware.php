<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DecryptRequestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Decrypt specific request data
        // dd($request->all());

        $decryptedData = $this->decryptRequestData($request->input('data'));


        // Replace the encrypted data in the request with the decrypted data
        $request->merge(['decrypted_data' => $decryptedData]);

        return $next($request);
    }

    private function decryptRequestData($encryptedData)
    {
        // Use your decryption logic here
        // For example, using Laravel's decrypt function:
        // $encryptedData = encrypt($encryptedData);
        // dd(decrypt($encryptedData));
        return decrypt($encryptedData);
    }
}
