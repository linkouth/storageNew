<?php
/**
 * Created by PhpStorm.
 * User: linkouth
 * Date: 04.08.18
 * Time: 22:09
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Shift;
use AppBundle\Form\ShiftType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ShiftController
 * @package AppBundle\Controller
 *
 * @Route("shift")
 */
class ShiftController extends Controller
{
    /**
     * Lists all shift entities
     *
     * @Route("/", name="shift_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $shifts = $em->getRepository(Shift::class)->findAll();

        return $this->render('shift/index.html.twig', array(
            'shifts' => $shifts,
        ));
    }

    /**
     * Prints all shift entities.
     *
     * @Route("/print", name="shift_print")
     * @Method("GET")
     */
    public function printAction()
    {
        $em = $this->getDoctrine()->getManager();

        $shifts = $em->getRepository(Shift::class)->findAll();

        $pdf = $this
            ->get("white_october.tcpdf")
            ->create('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $format = '210x297';
        $filename = "Смены ".$format;
        $pdf->AddPage('L', explode('x', $format));
        $pdf->SetFont('dejavusans', '', 14, '', true);
        $html = $this->renderView('shift/list.html.twig', array(
            'shift' => $shifts,
        ));
        $pdf->writeHTMLCell(
            $w = 0, $h = 0,
            $x = '', $y = '',
            $html, $border = 0,
            $ln = 1, $fill = 0,
            $reseth = true, $align = '',
            $autopadding = true
        );

        return $pdf->Output($filename . '.pdf', 'I');
    }

    /**
     * Creates a new shift entity
     *
     * @Route("/new", name="shift_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $shift = new Shift();
        $form = $this->createForm(ShiftType::class, $shift);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($shift);
            $em->flush();

            return $this->redirectToRoute('shift_show', array('id' => $shift->getId()));
        }

        return $this->render('shift/new.html.twig', array(
            'shift' => $shift,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a shift entity
     *
     * @Route("/{id}", name="shift_show")
     * @Method("GET")
     */
    public function showAction(Shift $shift)
    {
        return $this->render('shift/show.html.twig', array(
            'shift' => $shift,
        ));
    }

    /**
     * Finds and displays a form to edit shift entity
     *
     * @Route("/{id}/edit", name="shift_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Shift $shift)
    {
        $editForm = $this->createForm(ShiftType::class, $shift);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('shift_edit', array('id' => $shift->getId()));
        }

        return $this->render('shift/edit.html.twig', array(
            'shift' => $shift,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a shift entity
     *
     * @Route("/{id}/delete", name="shift_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request, Shift $shift)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($shift);
        $em->flush();

        return $this->redirectToRoute('shift_index');
    }
}