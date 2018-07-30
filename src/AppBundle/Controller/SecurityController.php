<?php
/**
 * Created by PhpStorm.
 * User: linkouth
 * Date: 25.07.18
 * Time: 17:09
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request, AuthenticationUtils $authUtils)
    {
        // получить ошибку входа, если она есть
        $error = $authUtils->getLastAuthenticationError();

        // последнее имя пользователя, введенное пользователем
        $lastUsername = $authUtils->getLastUsername();

        return $this->render('default/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {

    }
}