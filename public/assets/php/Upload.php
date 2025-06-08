<?php
use Illuminate\Support\Facades\Log;
function saveUploadedImage($fileInputName, $uploadDir = '~/assets/uploads/'): array {
    Log::info('saveUploadedImage function called with file input name: ' . $fileInputName);
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if (!isset($_FILES[$fileInputName]) || $_FILES[$fileInputName]['error'] !== UPLOAD_ERR_OK) {
        return ["state"=>false,'error' => 'No file uploaded or upload error occurred'];
    }

    $file = $_FILES[$fileInputName];

    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    if (!in_array($file['type'], $allowedTypes)) {
        return ["state"=>false,'error' => 'Only JPG, PNG, GIF, and WEBP files are allowed'];
    }

    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = uniqid() . '.' . $extension;
    $destination = $uploadDir . $filename;

    if (move_uploaded_file($file['tmp_name'], $destination)) {
        return ["state"=>true,'path' => $destination, 'basename'=>$filename];
    } else {
        return ["state"=>false,'error' => 'Failed to move uploaded file'];
    }
}
function deleteUploadedImage($filename, $uploadDir = 'uploads/'): array {
    $uploadDir = rtrim($uploadDir, '/') . '/';

    $safeFilename = basename($filename);

    $filePath = $uploadDir . $safeFilename;

    if (!file_exists($filePath)) {
        return ["state" => false, "message" => "File does not exist"];
    }

    if (unlink($filePath)) {
        return ["state" => true, "message" => "File deleted successfully"];
    } else {
        return ["state" => false, "message" => "Failed to delete the file"];
    }
}

?>