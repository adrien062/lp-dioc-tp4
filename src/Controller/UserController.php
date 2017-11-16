<?php

namespace App\Controller;

use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    /**
     * // FIXME: la route doit être /my_profile
     * @Route(
     *     path="/my_profile",
     *     name="my_profile"
     * )
     */
    public function myProfileAction()
    {
        $user=$this->getUser();
        return $this->render('User/my_profile.html.twig', ['user'=>$user]);
    }

    /**
     * // FIXME: la route doit être /profile/3 par exemple
     * @Route(
     *     path="/profile/{id}",
     *     name="profile_id"
     * )
     */
    public function profileAction(User $user)
    {
        // FIXME: un utilisateur connecté qui se rend sur sa propre page est redirigé vers /my_profile

        $userCo=$this->getUser();
        if($user->getId()== $userCo->getId())
        {
            return $this->redirectToRoute('my_profile');
        }
        return $this->render('User/profile.html.twig', ['user' => $user]);
    }
}
