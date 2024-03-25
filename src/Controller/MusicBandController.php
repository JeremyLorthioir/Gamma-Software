<?php

namespace App\Controller;

use App\Entity\MusicBand;
use App\Service\MusicBandService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Exception\ValidationFailedException;

class MusicBandController extends AbstractController
{
    #[Route('/music/band', name: 'app_music_band', methods: ['GET'])]
    public function index(MusicBandService $musicBandService): JsonResponse
    {
        return $this->json($musicBandService->getMusicBands());
    }

    #[Route('/music/band/{id}', name: 'app_music_band_show', methods: ['GET'])]
    public function show(MusicBandService $musicBandService, int $id): JsonResponse
    {
        try {
            $musicBand = $musicBandService->getMusicBandById($id);
        } catch (\Exception $e) {
            return $this->json($e->getMessage(), $e->getCode());
        }

        return $this->json($musicBand);
    }

    #[Route('/music/band', name: 'app_music_band_create', methods: ['POST'])]
    public function create(
        #[MapRequestPayload(
            acceptFormat: 'json',
            validationGroups: ['strict', 'read'],
            validationFailedStatusCode: Response::HTTP_NOT_FOUND
        )] MusicBand $musicBand,
        MusicBandService $musicBandService
    ): JsonResponse {
        try {
            $musicBand = $musicBandService->createMusicBand($musicBand);
        } catch (ValidationFailedException $validationFailedException) {
            return $this->json($validationFailedException->getViolations(), Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Exception $e) {
            return $this->json($e->getMessage(), $e->getCode());
        }

        return $this->json($musicBand, Response::HTTP_CREATED);
    }

    #[Route('/music/band/{id}', name: 'app_music_band_update', methods: ['PUT', 'PATCH'])]
    public function update(
        #[MapRequestPayload(
            acceptFormat: 'json',
            validationGroups: ['strict', 'read'],
            validationFailedStatusCode: Response::HTTP_NOT_FOUND
        )] MusicBand $musicBand,
        MusicBandService $musicBandService,
        int $id
    ): JsonResponse {
        try {
            $musicBand = $musicBandService->updateMusicBand($id, $musicBand);
        } catch (ValidationFailedException $validationFailedException) {
            return $this->json($validationFailedException->getViolations(), Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Exception $e) {
            return $this->json($e->getMessage(), $e->getCode());
        }

        return $this->json($musicBand);
    }

    #[Route('/music/band/{id}', name: 'app_music_band_delete', methods: ['DELETE'])]
    public function delete(MusicBandService $musicBandService, int $id): JsonResponse
    {
        try {
            $musicBandService->deleteMusicBrand($id);
        } catch (\Exception $e) {
            return $this->json($e->getMessage(), $e->getCode());
        }

        return $this->json('La groupe a bien été supprimé');
    }

    #[Route('/music/band/upload', name: 'app_music_band_delete', methods: ['POST'])]
    public function upload(Request $request, MusicBandService $musicBandService): JsonResponse
    {
        try {
            $musicBandService->uploadMusicBrand($request->files->get('import'));
        } catch (ValidationFailedException $validationFailedException) {
            return $this->json($validationFailedException->getViolations(), Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Exception $e) {
            return $this->json($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }

        return $this->json('Les groupes ont bien été importés');
    }
}
