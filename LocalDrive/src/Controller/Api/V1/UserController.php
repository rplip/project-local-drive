<?php

namespace App\Controller\Api\V1;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/api/v1/user", name="api_v1_user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="userList", methods={"GET"})
     */
    public function list(UserRepository $userRepository, SerializerInterface $serializer)
    {
        //Liste de tout les utilisateurs
        $users = $userRepository->findAll();
        $data = $serializer->normalize($users, null, ['groups' => 'api_v1']);

        return $this->json($data);
    }

    /**
     * @Route("/{id}/update", name="user", methods={"PUT"})
     */
    public function update(int $id, Request $request, SerializerInterface $serializer, UserRepository $ur)
    {

        $parametersAsArray = [];
        $content = $request->getContent();
        $parametersAsArray = json_decode($content, true);

       
        $inputEmail = $parametersAsArray['email'];
        $inputLastname = $parametersAsArray['lastname'];
        $inputFirstname = $parametersAsArray['firstname'];
        $inputNumber = $parametersAsArray['number'];
        $inputStreet = $parametersAsArray['street'];
        $inputZip = $parametersAsArray['zip'];
        $inputCity = $parametersAsArray['city'];
        $inputPhone = $parametersAsArray['phone'];

        $em = $this->getDoctrine()->getManager();
        $user = $ur->find($id);

        if (!$user) {
            throw $this->createNotFoundException(
                'No user found for email'.$inputEmail
            );
        }


        $user->setLastname($inputLastname);
        $user->setFirstName($inputFirstname);
        $user->setNumber($inputNumber);        
        $user->setStreet($inputStreet);
        $user->setZip($inputZip);
        $user->setCity($inputCity);
        $user->setPhone($inputPhone);
        $user->setUpdatedAt(New \DateTime);

        $em->persist($user);
        $em->flush();

        $data = $serializer->normalize($user, null, ['groups' => 'api_v1_update']);
        
        return $this->json($data);
    }

    /**
     * @Route("/{id}/upload-image", name="uploadImageUser", methods={"POST"})
     */
    public function uploadImage(int $id, UserRepository $ur, Request $request, SerializerInterface $serializer)
    {
        //On recupere le fichier
        $image = $request->files->get('image');
        //On crée un nom unique avec la même extension que le fichier originel
        $imageName = md5(uniqid()).'.'.$image->guessExtension();
        //On enregistre le fichier dans le dossier /public/images/users
        $image->move($this->getParameter('upload_image_user'), $imageName);

        $em = $this->getDoctrine()->getManager();
        $user = $ur->find($id);
        $user->setImage($imageName);
        $em->persist($user);
        $em->flush();

        $data = $serializer->normalize($user, null, ['groups' => 'api_v1_image']);
        return $this->json($data);

    }

    /**
     * @Route("/{id}", name="userShow", methods={"GET"}, requirements={"id":"\d+"})
     */
    public function show(User $user, SerializerInterface $serializer)
    {
        
        $data = $serializer->normalize($user, null, ['groups' => ['api_v1', 'api_v1_cart']]);
        return $this->json($data);
    }
}
