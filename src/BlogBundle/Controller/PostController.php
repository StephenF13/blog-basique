<?php

namespace BlogBundle\Controller;


use BlogBundle\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BlogBundle\Entity\Post;
use BlogBundle\Entity\User;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use BlogBundle\Form\PostType;


class PostController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $posts = $em->getRepository('BlogBundle:Post')->findAll();


        return $this->render('BlogBundle:Post:index.html.twig', [
            'posts' => $posts,
        ]);
    }

    public function viewAction($id)
    {

        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository('BlogBundle:Post')->find($id);

        // $advert est donc une instance de OC\PlatformBundle\Entity\Advert
        // ou null si l'id $id n'existe pas, d'où ce if :
        if (null === $post) {
            throw new NotFoundHttpException("L'article n'existe pas.");
        }


        return $this->render('BlogBundle:Post:view.html.twig', [
            'post' => $post,
        ]);
    }

    public function addPostAction(Request $request)
    {
        $post = new Post();
        $user = $this->getUser();
        $post->setAuthor($this->getUser());

        $form   = $this->get('form.factory')->create(PostType::class, $post);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Article bien enregistrée.');

            return $this->redirectToRoute('blog_view', array('id' => $post->getId()));
        }

        return $this->render('BlogBundle:Post:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }



}

