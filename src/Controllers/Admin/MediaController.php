<?php

namespace Omnispear\Media\Controllers\Admin;

use Omnispear\Media\Controllers\Controller;
use Omnispear\Media\Requests\MediaUploadRequest;
use Omnispear\Media\Services\MediaService;

class MediaController extends Controller
{
    /**
     * @var MediaService
     */
    private $mediaService;

    /**
     * MediaController constructor
     *
     * @param MediaService $mediaService
     */
    public function __construct(MediaService $mediaService)
    {
        $this->mediaService = $mediaService;
    }

    /**
     * Uploads media from file
     *
     * @param MediaUploadRequest $request
     * @return array
     */
    public function upload(MediaUploadRequest $request)
    {
        $media = $this->mediaService->createFromFile($request->file('file'));

        if ($media) {
            return route('media.download', $media->storage_location, false);
        }

        return [
            'status' => 'Failure'
        ];
    }
}