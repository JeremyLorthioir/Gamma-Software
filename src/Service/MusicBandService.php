<?php

namespace App\Service;

use App\Entity\MusicBand;
use App\Repository\MusicBandRepository;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Response;
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
}
