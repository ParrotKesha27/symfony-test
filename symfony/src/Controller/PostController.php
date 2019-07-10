<?php

namespace App\Controller;

use App\Entity\BlogPost;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\BlogPostType;
use Cocur\Slugify\Slugify;

class PostController extends AbstractController
{
    /**
     * @Route("/posts", name="blog_post")
     */
    public function posts(Request $request, PaginatorInterface $paginator)
    {
        $title = $request->query->get('title');
        $repository = $this->getDoctrine()->getRepository(BlogPost::class);
        $queryBuilder = $repository->getWithSearchQueryBuilder($title);

        $pagination = $paginator->paginate(
            $queryBuilder,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('post/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    /**
     * @Route("/posts/new", name="post_new")
     */
    public function addPost(Request $request, EntityManagerInterface $em)
    {
        $post = new BlogPost();
        $form = $this->createForm(BlogPostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('blog_post');
        }

        return $this->render('post/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/posts/{slug}", name="blog_show")
     */
    public function post(BlogPost $post)
    {
        return $this->render('post/show.html.twig', [
            'post' => $post
        ]);
    }

    /**
     * @param BlogPost $post
     * @param Slugify $slugify
     * @param Request $request
     * @Route("posts/{slug}/edit", name="blog_edit")
     */
    public function edit(BlogPost $post, Slugify $slugify, Request $request)
    {
        $form = $this->createForm(BlogPostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $post->setSlug($slugify->slugify($post->getTitle()));
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('blog_show', [
                'slug' => $post->getSlug(),
            ]);
        }

        return $this->render('post/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param BlogPost $post
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("posts/{slug}/delete", name="blog_delete")
     */
    public function delete(BlogPost $post)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($post);
        $em->flush();

        return $this->redirectToRoute('blog_post');
    }
}
