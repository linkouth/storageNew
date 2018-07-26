<?php
/**
 * Created by PhpStorm.
 * User: linkouth
 * Date: 22.07.18
 * Time: 13:57
 */

namespace AppBundle\Controller;
use AppBundle\Entity\Loader;
use AppBundle\Form\LoaderType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class LoaderController
 * @package AppBundle\Controller
 *
 * @Route("loader")
 */
class LoaderController extends Controller
{
    /**
     * Lists all loader entities
     *
     * @Route("/", name="loader_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $loaders = $em->getRepository(Loader::class)->findAll();

        return $this->render('loader/index.html.twig', array(
            'loaders' => $loaders,
        ));
    }

    /**
     * Creates a new loader entity
     *
     * @Route("/new", name="loader_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $loader = new Loader();
        $form = $this->createForm(LoaderType::class, $loader);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($loader);
            $em->flush();

            return $this->redirectToRoute('loader_show', array('id' => $loader->getId()));
        }

        return $this->render('loader/new.html.twig', array(
            'loader' => $loader,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a loader entity
     *
     * @Route("/{id}", name="loader_show")
     * @Method("GET")
     */
    public function showAction(Loader $loader)
    {
        return $this->render('loader/show.html.twig', array(
            'loader' => $loader,
        ));
    }

    /**
     * Finds and displays a form to edit loader entity
     *
     * @Route("/{id}/edit", name="loader_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Loader $loader)
    {
        $editForm = $this->createForm(LoaderType::class, $loader);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('loader_edit', array('id' => $loader->getId()));
        }

        return $this->render('loader/edit.html.twig', array(
            'loader' => $loader,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a good entity
     *
     * @Route("/{id}/delete", name="loader_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request, Loader $loader)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($loader);
        $em->flush();

        return $this->redirectToRoute('loader_index');
    }
}