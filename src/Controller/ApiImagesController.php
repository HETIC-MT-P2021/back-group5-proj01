<?php

namespace App\Controller;
use App\Entity\Images;


use Symfony\Component\Serializer\Serializer; 
use App\Repository\ImagesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;


use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;



class ApiImagesController extends AbstractController
{
    /**
     * @Route("/api/images", name="api_images_index", methods={"GET"})
     */
    public function index(ImagesRepository $imagesRepository)
    {
        return $this->json($imagesRepository->findAll(), 200, [], ['groups' => 'image:read']);
    }
    
        /**
     * @Route("/api/images/{id}", name="api_images_index", methods={"GET"})
     */
    public function getImage(Images $images)
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $jsonContent = $serializer->serialize($images, 'json', [
            'circular_reference_handler' => function ($object) {
                return $object->getImageId();
            }
        ]);
        $response = new Response($jsonContent);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    /**
     * @Route("/api/images", name="api_images_store", methods={"POST"})
     */
    public function store(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, ValidatorInterface $validator) {
        $jsonRecu = $request->getContent();
        try {
            $images = $serializer->deserialize($jsonRecu, Images::class, 'json');
            $images->setCreatedAt(new \DateTime());
            $errors = $validator->validate($images);

            if (count($errors) > 0) {
                return $this->json($errors, 400);
        }


        $em->persist($images);
        $em->flush();
        return $this->json($images, 201, [], ['groups' => 'image:read']);
        } catch(NotEncodableValueException $e) {
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage()
            ], 400);
        }
        

    }
}
