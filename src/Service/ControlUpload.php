<?php

namespace App\Service;

use App\Entity\Ressource;

class ControlUpload
{
    public function extensionValidity(Ressource $ressource): ?string
    {
        if (null !== $ressource->getimageFile()) {
            $mimeType = $ressource->getimageFile()->getMimeType();
        }
        $fileTypes = [
            'image' => ['jpg', 'jpeg', 'png', 'gif'],
            'application' => ['pdf',],
            'video' => ['mp4',],
        ];

        foreach ($fileTypes as $type => $extensionArray) {
            foreach ($extensionArray as $extension) {
                if (isset($mimeType) && $mimeType === "$type/$extension") {
                    return $type === 'application' ? 'pdf' : $type;
                }
            }
        }
        return 'Veuillez sélectionner le bon format de fichier (Jpg,Jpeg,Png,Gif,Pdf,mp4) !';
    }
}
