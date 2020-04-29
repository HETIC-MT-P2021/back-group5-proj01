<?php

namespace App\Controller;
use App\Entity\Category;
use Symfony\Component\Serializer\Serializer; 

use App\Repository\CategoryRepository;
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



class ApiCategoriesController extends AbstractController
{
    /**
     * @Route("/api/categories", name="api_categories_index", methods={"GET"})
     */
    public function index(CategoryRepository $categoryRepository)
    {
        return $this->json($categoryRepository->findAll(), 200, [], ['groups' => 'image:read']);
    }
    /**
     * @Route("/api/categories/{id}", name="api_category_index", methods={"GET"})
     */
    public function getCategory(Category $category)
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $jsonContent = $serializer->serialize($category, 'json', [
            'circular_reference_handler' => function ($object) {
                return $object->getCategoryId();
            }
        ]);
        $response = new Response($jsonContent);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }



    /**
     * @Route("/api/categories/{id}", name="supprimer", methods={"DELETE"})
     */
    public function removeCategory(Category $category)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($category);
        $entityManager->flush();
        return new Response('ok');
    }

    
    /**
     * @Route("/api/categories", name="api_category_store", methods={"POST","OPTIONS"})
     */
    public function store(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, ValidatorInterface $validator) {
        $jsonRecu = $request->getContent();
        try {
            $category = $serializer->deserialize($jsonRecu, Category::class, 'json');
            $errors = $validator->validate($category);

            if (count($errors) > 0) {
                return $this->json($errors, 400);
        }
    
    


        $em->persist($category);
        $em->flush();
        return $this->json($category, 201, [], ['groups' => 'image:read']);
        } catch(NotEncodableValueException $e) {
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
