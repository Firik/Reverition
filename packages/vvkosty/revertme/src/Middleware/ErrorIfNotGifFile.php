<?php

namespace vvkosty\revertme\Middleware;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;

class ErrorIfNotGifFile
{

    /** @var array */
    protected $allowedFileExtensions = ['gif'];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     *
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        /** @var \Illuminate\Http\UploadedFile $uploadedFile */
        $uploadedFile = $request->file()['file'];
        if (!($uploadedFile instanceof UploadedFile) ||
            !in_array($uploadedFile->extension(), $this->allowedFileExtensions, true)
        ) {
            return JsonResponse::create(
                'Invalid file format',
                JsonResponse::HTTP_BAD_REQUEST
            );
        }

        return $next($request);
    }
}
