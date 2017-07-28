<?php
/**
 * Created by PhpStorm.
 * User: lucio
 * Date: 26/07/17
 * Time: 16:45
 *
 *  * To test use this JSON {
 *                          "name": "Lucio",
 *                          "role": "yyyy"
 *                       }
 * Content-Type: application/json
 *
 */

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


class UserController extends FOSRestController
{

    /**
     * @Rest\Get("/user")
     * @Method("POST")
     *
     * Get all users
     */
    public function getUserAction()
    {
        $restresult = $this->getDoctrine()->getRepository('AppBundle:User')->findAll();
        if ($restresult === null) {
            $data = ['postUsersAction' => 'Database empty'];
            $view = $this->view($data, Response::HTTP_INTERNAL_SERVER_ERROR);
            return $view;
        }

        $view = $this->view($restresult, Response::HTTP_OK);
        return $view;
    }

    /**
     * @Rest\Get("/user/{id}")
     * @Method("POST")
     */
    public function getoneUserAction($id)
    {
        $restresult = $this->getDoctrine()->getRepository('AppBundle:User')->find($id);
        if ($restresult === null) {
            $data = ['postUsersAction' => 'Register not found'];
            $view = $this->view($data, Response::HTTP_INTERNAL_SERVER_ERROR);
            return $view;
        }

        $view = $this->view($restresult, Response::HTTP_OK);
        return $view;
    }

    /**
     * @Rest\Post("/user/new")
     * @Method("POST")
     *
     */
    public function newUserAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->submit($data);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        $data = ['postUsersAction' => '[POST] /users/new => User added'];
        $view = $this->view($data, Response::HTTP_OK);
        return $view;
    }


    /**
     * @Rest\Put("/user/{id}")
     * @Method("PUT")
     *
     * @ParamConverter("post", class="AppBundle:User")
     *
     * Use paramConverter to inject the entity post, of which will be searched using id
     *
     */
    public function updateAction(Request $request, $id, User $post)
    {

        $data = json_decode($request->getContent(), true);

        $form = $this->createForm(UserType::class, $post);
        $form->submit($data);

        $em = $this->getDoctrine()->getManager();
        $em->persist($post);
        $em->flush();

        $data = ['postUsersAction' => '[PUT] /users/new => User updated Id: '.$id];
        $view = $this->view($data, Response::HTTP_OK);
        return $view;
    }


    /**
     * @Rest\Delete("/user/{id}")
     * @Method("DELETE")
     *
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $restresult = $this->getDoctrine()->getRepository('AppBundle:User')->find($id);
        if ($restresult === null) {
            $data = ['postUsersAction' => 'Delete: Register not found'];
            $view = $this->view($data, Response::HTTP_INTERNAL_SERVER_ERROR);
            return $view;
        }

        $em->remove($restresult);
        $em->flush();

        $data = ['postUsersAction' => '[PUT] /users/new => User Deleted Id: '.$id];
        $view = $this->view($data, Response::HTTP_OK);
        return $view;

    }



}
