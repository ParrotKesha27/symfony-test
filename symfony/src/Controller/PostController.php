<?php

namespace App\Controller;

use App\Entity\BlogPost;
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
    public function posts()
    {
        $repository = $this->getDoctrine()->getRepository(BlogPost::class);
        $posts = $repository->findAll();

        return $this->render('post/index.html.twig', [
            'posts' => $posts,
        ]);
    }

    /**
     * @param Request $request
     * @param Slugify $slugify
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     * @Route("/posts/new", name="post_new")
     */
    public function addPost(Request $request, Slugify $slugify)
    {
        $post = new BlogPost();
        $form = $this->createForm(BlogPostType::class, $post);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $post->setSlug($slugify->slugify($post->getTitle()));
            $post->setCreatedAt(new \DateTime());

            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('blog_post');
        }

        return $this->render('post/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/posts/search", name="blog_search")
     */
    public function search(Request $request)
    {
        $query = $request->query->get('title');
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository(BlogPost::class)->searchByTitle($query);

        return $this->render('post/search_result.html.twig', [
            'posts' => $posts
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
