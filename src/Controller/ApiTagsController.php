<?php

namespace App\Controller;
use App\Entity\Tags;

use App\Repository\TagsRepository;
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



class ApiTagsController extends AbstractController
{
    /**
     * @Route("/api/tags", name="api_tags_index", methods={"GET"})
     */
    public function index(TagsRepository $tagsRepository)
    {
        return $this->json($tagsRepository->findAll(), 200, []);
    }

    /**
     * @Route("/api/tags", name="api_tags_store", methods={"POST"})
     */
    public function store(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, ValidatorInterface $validator) {
        $jsonRecu = $request->getContent();
        try {
            $tags = $serializer->deserialize($jsonRecu, Tags::class, 'json');
            $errors = $validator->validate($tags);

            if (count($errors) > 0) {
                return $this->json($errors, 400);
        }


        $em->persist($tags);
        $em->flush();
        return $this->json($tags, 201, []);
        } catch(NotEncodableValueException $e) {
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage()
            ], 400);
        }
        

    }
}
