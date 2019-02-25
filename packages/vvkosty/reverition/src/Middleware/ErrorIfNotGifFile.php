<?php

namespace vvkosty\reverition\Middleware;

use Illuminate\Http\JsonResponse;

class ErrorIfNotGifFile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        /** @var \Illuminate\Http\UploadedFile $uploadedFile */
        $uploadedFile = $request->file()['file'];
        $extension = $uploadedFile->extension();
        if (!$request->matchesType($extension, 'gif')) {
            return JsonResponse::create(
                'Invalid file format',
                JsonResponse::HTTP_BAD_REQUEST
            );
        }

        return $next($request);
    }
}
