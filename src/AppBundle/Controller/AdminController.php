<?php
/**
 * Created by PhpStorm.
 * User: linkouth
 * Date: 24.07.18
 * Time: 15:05
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Admin;
use AppBundle\Form\AdminType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AdminController
 * @package AppBundle\Controller
 *
 * @Route("admin")
 */
class AdminController extends Controller
{
    /**
     * Lists all admin entities
     *
     * @Route("/", name="admin_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $admins = $em->getRepository(Admin::class)->findAll();

        return $this->render('admin/index.html.twig', array(
            'admins' => $admins,
        ));
    }

    /**
     * Creates and displays an admin entity
     *
     * @Route("/new", name="admin_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $admin = new Admin();
        $admin->setRole('ROLE_ADMIN');
        $form = $this->createForm(AdminType::class, $admin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $encoder = $this->get('security.password_encoder');
            $admin->setPassword($encoder->encodePassword($admin, $form->get('password')->getData()));

            $em = $this->getDoctrine()->getManager();
            $em->persist($admin);
            $em->flush();

            return $this->redirectToRoute('admin_show', array('id' => $admin->getId()));
        }

        return $this->render('admin/new.html.twig', array(
            'admin' => $admin,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays an admin entity
     *
     * @Route("/{id}", name="admin_show")
     * @Method("GET")
     */
    public function showAction(Admin $admin)
    {
        return $this->render('admin/show.html.twig', array(
            'admin' => $admin,
        ));
    }

    /**
     * Finds and displays a form to edit admin entity
     *
     * @Route("/{id}/edit", name="admin_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Admin $admin)
    {
        $editForm = $this->createForm(AdminType::class, $admin);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_edit', array('id' => $admin->getId()));
        }

        return $this->render('admin/edit.html.twig', array(
            'admin'     => $admin,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes an admin entity
     *
     * @Route("/{id}/delete", name="admin_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request, Admin $admin)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($admin);
        $em->flush();

        return $this->redirectToRoute('admin_index');
    }
}