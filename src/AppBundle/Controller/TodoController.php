<?php

namespace AppBundle\Controller;
use AppBundle\Entity\Todo;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TodoController extends Controller
{
    /**
     * @Route("/", name="todo_list")
     */
    public function listAction(Request $request)
    {

       $todos = $this->getDoctrine()
            ->getRepository('AppBundle:Todo')
            ->findAll();
        
        return $this->render("todo/index.html.twig",[
            'todos'=>$todos
        ]);
    }

    /**
     * @Route("/create", name="todo_create")
     */
    public function createAction(Request $request){

        $todo = new Todo();

        $form = $this->createFormBuilder($todo)
            ->add('name',TextType::class,
                array('attr'=>
                    array(
                        'class'=>'form-control',
                        'style'=>'margin-bottom:15px'
                    )
                )
            )
            ->add('category',TextType::class,
                array('attr'=>
                    array(
                        'class'=>'form-control',
                        'style'=>'margin-bottom:15px'
                    )
                )
            )
            ->add('description',TextareaType::class,
                array('attr'=>
                    array(
                        'class'=>'form-control',
                        'style'=>'margin-bottom:15px;height: 250px;'
                    )
                )
            )
            ->add('prioity',ChoiceType::class,
                array(
                    'choices'=> array(
                        'Low' => 'Low',
                        'Normal'=> 'Normal',
                        'High'=>'High'
                    ),
                    'attr'=>
                        array(
                            'class'=>'form-control',
                            'style'=>'margin-bottom:15px'
                        )
                )
            )
            ->add('due_date',DateTimeType::class,
                array(                
                    'attr'=>
                        array(
                            'class'=>'formcontrol',
                            'style'=>'margin-bottom:15px'
                        )
                )
            )
            ->add('save', SubmitType::class, 
                    array(
                    'label' => 'Create Task',
                    'attr'=>
                        array(
                            'class'=>'btn btn-info',
                            'style'=>'margin-bottom:15px'
                        
                        )
                    )
                )
            ->getForm();

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){

                // get data From form
                $name = $form["name"]->getData();
                $category = $form["category"]->getData();
                $description = $form["description"]->getData();
                $prioity = $form["prioity"]->getData();
                $due_date = $form["due_date"]->getData();

                $now = new\DateTime('now');
                
                $todo->setName($name);
                $todo->setCategory($category);
                $todo->setDescription($description);
                $todo->setPrioity($prioity);
                $todo->setDueDate($due_date);
                $todo->setCreateDate($now);

                $commit = $this->getDoctrine()->getManager();
                $commit->persist($todo);
                $commit->flush();

                $this->addFlash(
                    'notice',
                    'Todo Added'
                );
                return $this->redirectToRoute('todo_list');

                
                // die($due_date);
            }



        // var_dump($todo);

       return $this->render("todo/create.html.twig",[
           "form"=> $form->createView(),
           "base_url"=>realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR
       ]);
    }

    /**
     * @Route("/edit/{id}", name="todo_edit")
     */
    public function editAction($id,Request $request){
        return $this->render("todo/edit.html.twig",[
            "base_url"=>realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR
        ]);
    }

    /**
     * @Route("/detail/{id}", name="todo_detail")
     */
    public function detailAction($id,Request $request){
        return $this->render("todo/details.html.twig",[
            "base_url"=>realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR
        ]);
    }


}
