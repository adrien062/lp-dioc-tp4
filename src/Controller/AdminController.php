<?php

namespace App\Controller;

use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route(path="/admin")
 */
class AdminController extends Controller
{
    /**
     * @Route(
     *     path="",
     *     name="admin_dashboard"
     * )
     */
    public function dashboardAction()
    {
        // FIXME: Récupérer les utilisateurs non admin
        $userAdmin=$this->getUser();
        $em=$this->getDoctrine()->getManager();
        $repo=$em->getRepository(User::class);
        $users = $repo->findBy(["isAdmin" => false]);


        return $this->render('Admin/dashboard.html.twig', ['users' => $users,'admin'=>$userAdmin]);
    }

    /**
     * @Route(path="/delete-user/{id}",name="delete_user")
     */
    public function deleteUserAction(User $user)
    {
        // FIXME: Supprime l'utilisateur est redirige sur /admin, la route doit être /delete-user/1
        $em=$this->getDoctrine()->getManager();
        $repo=$em->getRepository(User::class);
        $userSupp=$repo->find($user);
        $em->remove($userSupp);
        $em->flush();

        return $this->redirectToRoute('admin_dashboard');
    }
}
