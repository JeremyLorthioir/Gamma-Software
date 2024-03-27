<?php

namespace App\Service;

use App\Entity\MusicBand;
use App\Repository\MusicBandRepository;
use Shuchkin\SimpleXLSX;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class MusicBandService
{
    protected $musicBandRepository;
    protected $validator;

    public function __construct(MusicBandRepository $musicBandRepository, ValidatorInterface $validator)
    {
        $this->musicBandRepository = $musicBandRepository;
        $this->validator = $validator;
    }

    /**
     * @return MusicBand[] Returns an array of MusicBand objects
     */
    public function getMusicBands()
    {
        return $this->musicBandRepository->findAll();
    }

    public function getMusicBandById(int $id): MusicBand
    {
        $musicBand = $this->musicBandRepository->findOneBy(['id' => $id]);

        if (null === $musicBand) {
            throw new BadRequestException(sprintf("Aucun groupe trouvé pour l'id %s", $id), Response::HTTP_NOT_FOUND);
        }

        return $musicBand;
    }

    public function createMusicBand(MusicBand $musicBand): MusicBand
    {
        $errors = $this->validator->validate($musicBand);
        if (count($errors)) {
            throw new ValidationFailedException("Le groupe n'est pas valide", $errors);
        }

        $this->musicBandRepository->save($musicBand);

        return $musicBand;
    }

    public function updateMusicBand(int $id, MusicBand $payload): MusicBand
    {
        $musicBand = $this->getMusicBandById($id);

        $payloadReflection = new \ReflectionObject($payload);
        $payloadProperties = $payloadReflection->getProperties();

        $musicBandReflection = new \ReflectionObject($musicBand);

        foreach ($payloadProperties as $property) {
            $propertyName = $property->getName();

            if ($musicBandReflection->hasProperty($propertyName)) {
                $musicBandProperty = $musicBandReflection->getProperty($propertyName);
                $musicBandProperty->setAccessible(true);

                $property->setAccessible(true);
                $value = $property->getValue($payload);

                if (null !== $value) {
                    $musicBandProperty->setValue($musicBand, $value);
                }
            }
        }

        $errors = $this->validator->validate($musicBand);
        if (count($errors)) {
            throw new ValidationFailedException("Le groupe n'est pas valide", $errors);
        }

        $this->musicBandRepository->save($musicBand, false);

        return $musicBand;
    }

    public function deleteMusicBrand($id): void
    {
        $this->musicBandRepository->remove($this->getMusicBandById($id));
    }

    public function uploadMusicBrand(?UploadedFile $file): void
    {
        $file_errors = $this->validator->validate(
            $file,
            [
                new NotBlank([
                    'message' => 'Please select a file to upload',
                ]),
                new File([
                    'maxSize' => '5M',
                    'mimeTypes' => [
                        'application/vnd.ms-excel',
                        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                    ],
                ]),
            ]
        );

        if (count($file_errors)) {
            throw new ValidationFailedException("Le fichier n'est pas valide", $file_errors);
        }

        if ($rows = SimpleXLSX::parse($file)->rows()) {
            // Start at 1 to avoid table header
            for ($i = 1; $i < count($rows); ++$i) {
                $row = $rows[$i];

                $musicBand = new MusicBand();
                $musicBand->setName($row[0]);
                $musicBand->setOrigin($row[1]);
                $musicBand->setCity($row[2]);
                $musicBand->setFoundationYear((int) $row[3]);
                $musicBand->setSeparationYear((int) $row[4]);
                $musicBand->setFounders($row[5]);
                $musicBand->setTotalMembers((int) $row[6]);
                $musicBand->setStyle($row[7]);
                $musicBand->setDescription($row[8]);

                $this->createMusicBand($musicBand);
            }
        } else {
            throw new BadRequestException(SimpleXLSX::parseError());
        }
    }
}
