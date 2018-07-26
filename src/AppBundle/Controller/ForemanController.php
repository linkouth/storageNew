<?php
/**
 * Created by PhpStorm.
 * User: linkouth
 * Date: 22.07.18
 * Time: 17:31
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Foreman;
use AppBundle\Form\ForemanType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ForemanController
 * @package AppBundle\Controller
 *
 * @Route("foreman")
 */
class ForemanController extends Controller
{
    /**
     * Lists all foreman entities
     *
     * @Route("/", name="foreman_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $foremen = $em->getRepository(Foreman::class)->findAll();

        return $this->render('foreman/index.html.twig', array(
            'foremen' => $foremen,
        ));
    }

    /**
     * Creates a new foreman entity
     *
     * @Route("/new", name="foreman_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $foreman = new Foreman();
        $foreman->setRole('ROLE_USER');
        $form = $this->createForm(ForemanType::class, $foreman);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $encoder = $this->get('security.password_encoder');
            $foreman->setPassword($encoder->encodePassword($foreman, $form->get('password')->getData()));

            $em = $this->getDoctrine()->getManager();
            $em->persist($foreman);
            $em->flush();

            return $this->redirectToRoute('foreman_show', array('id' => $foreman->getId()));
        }

        return $this->render('foreman/new.html.twig', array(
            'foreman' => $foreman,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a foreman entity
     *
     * @Route("/{id}", name="foreman_show")
     * @Method("GET")
     */
    public function showAction(Foreman $foreman)
    {
        return $this->render('foreman/show.html.twig', array(
           'foreman' => $foreman,
        ));
    }

    /**
     * Finds and displays a form to edit foreman entity
     *
     * @Route("/{id}/edit", name="foreman_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Foreman $foreman)
    {
        $editForm = $this->createForm(ForemanType::class, $foreman);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('foreman_edit', array('id' => $foreman->getId()));
        }

        return $this->render('foreman/edit.html.twig', array(
           'foreman' => $foreman,
           'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a foreman entity
     *
     * @Route("/{id}/delete", name="foreman_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request, Foreman $foreman)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($foreman);
        $em->flush();

        return $this->redirectToRoute('foreman_index');
    }
}