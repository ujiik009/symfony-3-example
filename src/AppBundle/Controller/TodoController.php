<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TodoController extends Controller
{
    /**
     * @Route("/todo", name="todo_list")
     */
    public function listAction(Request $request)
    {
       
        return $this->render("todo/index.html.twig",[
            "base_url"=>realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR
        ]);
    }

    /**
     * @Route("/todo/create", name="todo_create")
     */
    public function createAction(Request $request){
       return $this->render("todo/create.html.twig",[
           "base_url"=>realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR
       ]);
    }

    /**
     * @Route("/todo/edit/{id}", name="todo_edit")
     */
    public function editAction($id,Request $request){
        return $this->render("todo/edit.html.twig",[
            "base_url"=>realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR
        ]);
    }

    /**
     * @Route("/todo/detail/{id}", name="todo_detail")
     */
    public function detailAction($id,Request $request){
        return $this->render("todo/details.html.twig",[
            "base_url"=>realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR
        ]);
    }


}
