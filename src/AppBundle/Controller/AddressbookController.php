<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Person;
use AppBundle\Form\PersonType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Intl\Intl;

class AddressbookController extends Controller
{
    /**
     * @Route("/", name="list")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $people = $em->getRepository('AppBundle:Person')->findAll();

        return $this->render('AppBundle:Addressbook:list.html.twig', array(
            'people' => $people,
            'countries' => Intl::getRegionBundle()->getCountryNames()
        ));
    }

    /**
     * @Route("/create/{id}", defaults={"id"=null}, name="create")
     */
    public function createAction(Request $request)
    {
        if(($id = $request->get('id'))) {
            $em = $this->getDoctrine()->getManager();
            $person = $em->getRepository('AppBundle:Person')->findOneBy([
                'id' => $id
            ]);
        } else {
            $person = new Person();
        }

        $form = $this->createForm(PersonType::class, $person);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $person = $form->getData();

            $file = $person->getPicture();
            if(!empty($file)) {
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();

                try {
                    $file->move(
                        $this->getParameter('uploads'),
                        $fileName
                    );
                } catch (FileException $e) {
                    $form->get('picture')->addError('Could not upload file, error: ' . $e->getMessage());
                }

                $person->setPicture($fileName);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($person);
            $em->flush();

            $this->addFlash('success', 'Person has been saved');

            return $this->redirectToRoute('list');
        }

        return $this->render('AppBundle:Addressbook:create.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/view/{id}", name="view")
     */
    public function viewAction(Request $request)
    {
        if(($id = $request->get('id'))) {
            $em = $this->getDoctrine()->getManager();
            $person = $em->getRepository('AppBundle:Person')->findOneBy([
                'id' => $id
            ]);
        } else {
            return $this->redirectToRoute('list');
        }

        return $this->render('AppBundle:Addressbook:view.html.twig', array(
            'person' => $person
        ));
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function deleteAction(Request $request)
    {
        if(($id = $request->get('id'))) {
            $em = $this->getDoctrine()->getManager();
            $person = $em->getRepository('AppBundle:Person')->findOneBy([
                'id' => $id
            ]);

            $em->remove($person);
            $em->flush();
        }
        $this->addFlash('success', 'Person has been successfully deleted.');

        return $this->redirectToRoute('list');
    }

}
