<?php

namespace App\Controller\Api\V1;

use App\Repository\ShopRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class LoginController extends AbstractController
{
    /**
     * @Route("/api/v1/login", name="login", methods={"POST"})
     */
    public function login(Request $request, ShopRepository $shopRepository, SerializerInterface $serializer, UserRepository $userRepository)
    {
        $parametersAsArray = [];
        $content = $request->getContent();
        $parametersAsArray = json_decode($content, true);
        //On recupère les input username et password
        $searchInputMail = $parametersAsArray['username'];
        $searchInputPassword = $parametersAsArray['password'];
        //On verifie si l'email est présent en base de donneé (dans les tables shop et user)
        $searchMailInUser = $userRepository->searchIfMailIsHere($searchInputMail, $searchInputPassword);
        $searchMailInShop = $shopRepository->searchIfMailIsHere($searchInputMail, $searchInputPassword);

       

        if (!empty($searchMailInUser)) {
            //Si le mail est présent dans la table user
            $result = $serializer->normalize($searchMailInUser, null, ['groups' => ['login_search']]);

        }elseif (!empty($searchMailInShop)) {
            //Si le mail est présent dans la table shop
            $result = $serializer->normalize($searchMailInShop, null, ['groups' => ['login_search']]);
            
        }else {
            //Si le mail est absent des tables user et shop
            $result = false;
        };

        return $this->json($result);
    }
    

    /** 
    * @Route("/reset-password", name="reset_password",  methods={"PUT"})
    */
    public function resetPassword (Request $request,  ShopRepository $shopRepository, UserRepository $userRepository)
    {

        $parametersAsArray = [];
        $content = $request->getContent();
        $parametersAsArray = json_decode($content, true);
         // on recupere les passwords
        $searchInputMail = $parametersAsArray['username'];
        $searchInputOldPassword = $parametersAsArray['oldPassword'];
        $searchInputNewPassword = $parametersAsArray['newPassword'];
        $verifyPasswordInUser = $userRepository->searchIfMailIsHere($searchInputMail, $searchInputOldPassword);
        $verifyPasswordInShop = $shopRepository->searchIfMailIsHere($searchInputMail, $searchInputOldPassword);
       
            
            if($verifyPasswordInUser == false) {

                    if($verifyPasswordInShop == false) {

                        // Ni user, ni Shop, donc false
                        $result = false;

                    } else {
                        
                        // Pas User mais Shop donc se retrouve ici
                        $idShop = $verifyPasswordInShop[0]->getid();
                        $em = $this->getDoctrine()->getManager();
                        $shop = $shopRepository->find($idShop);
                        $shop->setPassword(password_hash($searchInputNewPassword, PASSWORD_DEFAULT));
                        $em->persist($shop);
                        $em->flush();

                        $result = $shop;
                    }
                
            } else {
                
                // User donc se retrouve ici
                $idUser = $verifyPasswordInUser[0]->getid();
                $em = $this->getDoctrine()->getManager();
                $user = $userRepository->find($idUser);
                $user->setPassword(password_hash($searchInputNewPassword, PASSWORD_DEFAULT));
                $em->persist($user);
                $em->flush();

                $result = $user;
            }
        
            return $this->json($result);
    }
}
