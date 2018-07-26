<?php
/**
 * Created by PhpStorm.
 * User: linkouth
 * Date: 21.07.18
 * Time: 18:26
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Good;
use AppBundle\Form\GoodType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class GoodController
 * @package AppBundle\Controller
 *
 * @Route("good")
 */
class GoodController extends Controller
{
    /**
     * Lists all goods entities
     *
     * @Route("/", name="good_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $goods = $em->getRepository(Good::class)->findAll();

        return $this->render('good/index.html.twig', array(
            'goods' => $goods,
        ));
    }

    /**
     * Create a new entity good
     *
     * @Route("/new", name="good_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $good = new Good();
        $form = $this->createForm(GoodType::class, $good);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($good);
            $em->flush();

            return $this->redirectToRoute('good_show', array('id' => $good->getId()));
        }

        return $this->render('good/new.html.twig', array(
            'good' => $good,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a good entity
     *
     * @Route("/{id}", name="good_show")
     * @Method("GET")
     */
    public function showAction(Good $good)
    {
        return $this->render('good/show.html.twig', array(
           'good' => $good,
        ));
    }

    /**
     * Displays a form to edit an existing good entity
     *
     * @Route("/{id}/edit", name="good_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Good $good)
    {
        $editForm = $this->createForm(GoodType::class, $good);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('good_edit', array(
                'id' => $good->getId()
            ));
        }

        return $this->render('good/edit.html.twig', array(
           'good' => $good,
           'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a good entity
     *
     * @Route("/delete/{id}", name="good_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request, Good $good)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($good);
        $em->flush();

        return $this->redirectToRoute('good_index');
    }
}