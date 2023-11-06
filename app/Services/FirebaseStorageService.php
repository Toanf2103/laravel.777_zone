<?php
namespace App\Services;

use Google\Cloud\Storage\StorageClient;
use Illuminate\Http\UploadedFile;

class FirebaseStorageService
{
    protected $storage;
    protected $bucketName;

    public function __construct()
    {
        $serviceAccountPath = storage_path('app/serviceAccountPath.json');
        $this->storage = new StorageClient([
            'projectId' => env('FIREBASE_PROJECT_ID'),
            'keyFilePath' => $serviceAccountPath
        ]);

        $this->bucketName = env('FIREBASE_STORAGE_BUCKET');
    }

    public function uploadImage(UploadedFile $file, $destinationPath)
    {
        $bucket = $this->storage->bucket($this->bucketName);

        $objectName = $destinationPath . '/' . $file->getClientOriginalName();

        $bucket->upload(
            file_get_contents($file->getPathname()),
            [
                'name' => $objectName,
            ]
        );

        return $objectName;
    }

    public function deleteImage($objectName)
    {
        $bucket = $this->storage->bucket($this->bucketName);

        $object = $bucket->object($objectName);

        if ($object->exists()) {
            $object->delete();
            return true;
        }

        return false;
    }
}
