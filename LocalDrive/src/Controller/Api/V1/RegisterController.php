<?php

namespace App\Controller\Api\V1;

use DateTime;
use App\Entity\Shop;
use App\Entity\User;
use App\Repository\ShopRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RegisterController extends AbstractController
{
    /**
     * @Route("/register", name="register", methods={"POST"})
     * 
     */
    public function register(Request $request, UserRepository $ur, ShopRepository $sr)
    {
        $parametersAsArray = [];
        $content = $request->getContent();
        $parametersAsArray = json_decode($content, true);

        //On récupère les inputs
        $inputEmail = $parametersAsArray['email'];
        $inputPassword = $parametersAsArray['password'];
        $inputIsShop = $parametersAsArray['isShop'];
        $inputName = $parametersAsArray['nom'];
        $inputFirstName = $parametersAsArray['prenom'];
        $inputJob = $parametersAsArray['job'];

        $em = $this->getDoctrine()->getManager();
        
         //On verifie que l'email n'est pas deja existant
        $checkEmailUser = $ur->checkMail($inputEmail);
        $checkEmailShop = $sr->checkMail($inputEmail);


        if($checkEmailUser or $checkEmailShop){
            return $this->json(false);
        } else {
    
            if($inputIsShop == "true") {

                //Si isShop est true on enregistre les infos dans table shop
                $shop = new Shop;
                $shop->setEmail($inputEmail);
                $shop->setName($inputName);
                $shop->setIsShop(true);
                $shop->setJob($inputJob);
                $shop->setRoles(["ROLE_SHOP"]);
                $shop->setCreatedAt(new DateTime);
                $shop->setPassword(password_hash($inputPassword, PASSWORD_DEFAULT));

                $em->persist($shop);
                $em->flush();

                return $this->json($shop);


            } elseif ($inputIsShop == "false") {

                //Si isShop est false on enregistre les infos dans la table user
                $user = New User;
                $user->setEmail($inputEmail);
                $user->setFirstname($inputFirstName);
                $user->setLastname($inputName);
                $user->setIsShop(false);
                $user->setRoles(["ROLE_USER"]);
                $user->setCreatedAt(new Datetime);
                $user->setPassword(password_hash($inputPassword, PASSWORD_DEFAULT));

                $em->persist($user);
                $em->flush();

                return $this->json($user);

            } else {
                return $this->json(false);
            }
        } 
        
    }
}