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

    public function uploadImage(UploadedFile $file, $imageName, $destinationPath)
    {
        $bucket = $this->storage->bucket($this->bucketName);

        $objectName = "$destinationPath/$imageName." . $file->getClientOriginalExtension();

        $bucket->upload(file_get_contents($file->getPathname()), ['name' => $objectName,]);

        $object = $bucket->object($objectName);
        $object->update(['acl' => []], ['predefinedAcl' => 'publicRead']);

        return [
            'full_url' => "https://storage.googleapis.com/{$this->bucketName}/{$objectName}",
            'short_url' => $objectName
        ];
    }


    public function uploadImageByLink($linkImg, $imageName, $destinationPath)
    {
        $bucket = $this->storage->bucket($this->bucketName);

        // Lấy phần mở rộng của tệp từ đường dẫn trực tiếp (link)
        $extension = 'jpg';

        $objectName = "$destinationPath/$imageName." . $extension;
        $bucket->upload(file_get_contents($linkImg), ['name' => $objectName]);
        
        $object = $bucket->object($objectName);
        $object->update(['acl' => []], ['predefinedAcl' => 'publicRead']);

        return [
            'full_url' => "https://storage.googleapis.com/{$this->bucketName}/{$objectName}",
            'short_url' => $objectName
        ];
    }

    public function uploadManyImages(array $files, $destinationPath)
    {
        $uploadedFiles = [];

        foreach ($files as $index => $file) {
            $imageName = $index + 1;
            $uploadedFile = $this->uploadImage($file, $imageName, $destinationPath);
            $uploadedFiles[] = $uploadedFile;
        }

        return $uploadedFiles;
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

    public function deleteAllImagesInFolder($folderPath)
    {
        $bucket = $this->storage->bucket($this->bucketName);
        $objects = $bucket->objects(['prefix' => $folderPath]);

        foreach ($objects as $object) {
            if ($object->exists()) {
                $object->delete();
            }
        }

        return true;
    }
}
