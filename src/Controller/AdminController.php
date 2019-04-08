<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Entity\AdminUnit;
use App\Entity\ExamsAndRecords;
use App\Entity\Faculty;
use App\Entity\HealthService;
use App\Entity\Student;
use App\Entity\StudentAffairs;
use App\Form\AdminType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_login", methods={"get","post"})
     * @param Request $request
     * @param Session $session
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function login(Request $request, Session $session){
        if($session->has("admin")){
            return $this->redirectToRoute("admin_dashboard");
        }
        $form = $this->createFormBuilder()
            ->add('username', TextType::class,[
                "attr"=>["placeholder" => "e.g: john", "class" => "form-control1"]])
            ->add('password', PasswordType::class,[
                "attr"=>["placeholder" => "e.g: minimum of 8 characters", "class" => "form-control1"]])
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $admin = $this->getDoctrine()
                ->getRepository(Admin::class)
                ->findOneBy(["username"=>$form->getData()["username"]]);
            if(is_null($admin)){
                $form->addError(new FormError("Oops! invalid username."));
                return $this->render("admin/login.html.twig",[
                    "form" => $form->createView()
                ]);
            }elseif ($admin->isPasswordValid($form->getData()["password"])){
                $session->set("admin",$admin->serialize());
                return $this->redirectToRoute("admin_dashboard");
            }
        }
        return $this->render("admin/login.html.twig",[
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/register", name="admin_register", methods={"get","post"});
     * @param Request $request
     * @param Session $session
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function register(Request $request, Session $session){
        $admin = new Admin();
        $form = $this->createForm(AdminType::class,$admin);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $admin->setRegisteredDate(new \DateTime("now"));
            $admin->setPassword($admin->getHashedPassword());
            $em = $this->getDoctrine()->getManager();
            $em->persist($admin);
            $em->flush();
            $session->set("admin",$admin->serialize());
            return $this->redirectToRoute("admin_dashboard");
        }
        return $this->render("admin/register.html.twig",[
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("admin/dashboard", name="admin_dashboard", methods={"get"})
     * @param Session $session
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function index(Session $session){
        if(!$session->has("admin")){
            return $this->redirectToRoute("admin_login");
        }
        dump($session->get("admin"));
        return $this->render("admin/dashboard.html.twig");
    }

    /**
     * @Route("/admin/logout", name="admin_logout")
     * @param Session $session
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function logout(Session $session){
        $session->clear();
        return $this->redirectToRoute("admin_login");
    }

    /**
     * @Route("/admin/students",name="admin_view_students", methods={"get"})
     * @param Session $session
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function viewStudents(Session $session){
        if(!$session->has("admin")){
            return $this->redirectToRoute("admin_login");
        }
        $admin = new Admin();
        $admin->unserialize($session->get("admin"));
        $records = null;
        switch($admin->getUnit()){
            case "AdminUnit":
                $records = $this->getDoctrine()->getRepository(AdminUnit::class)->findAll();
                break;
            case "HealthService":
                $records = $this->getDoctrine()->getRepository(HealthService::class)->findAll();
                break;
            case "ExamsAndRecords":
                $records = $this->getDoctrine()->getRepository(ExamsAndRecords::class)->findAll();
                break;
            case "Faculty":
                $records = $this->getDoctrine()->getRepository(Faculty::class)->findAll();
                break;
            case "StudentAffairs":
                $records = $this->getDoctrine()->getRepository(StudentAffairs::class)->findAll();
                break;
            default:
                return $this->redirectToRoute("admin_login");
        }
        return $this->render("admin/view_students.html.twig",[
            "records" => $records
        ]);
    }

    /**
     * @Route("/admin/pending",name="admin_pending_students", methods={"get"})
     * @param Session $session
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function pendingStudents(Session $session){
        if(!$session->has("admin")){
            return $this->redirectToRoute("admin_login");
        }
        $admin = new Admin();
        $admin->unserialize($session->get("admin"));
        $record = null;
        switch ($admin->getUnit()){
            case "AdminUnit":
                $record = $this->getDoctrine()
                    ->getRepository(AdminUnit::class)
                    ->findBy(["approve" => 0]);
                break;
            case "HealthService":
                $record = $this->getDoctrine()
                    ->getRepository(HealthService::class)
                    ->findBy(["approve" => 0]);
                break;
            case "ExamsAndRecords":
                $record = $this->getDoctrine()
                    ->getRepository(ExamsAndRecords::class)
                    ->findBy(["approve" => 0]);
                break;
            case "Faculty":
                $record = $this->getDoctrine()
                    ->getRepository(Faculty::class)
                    ->findBy(["approve" => 0]);
                break;
            case "StudentAffairs":
                $record = $this->getDoctrine()
                    ->getRepository(StudentAffairs::class)
                    ->findBy(["approve" => 0]);
                break;
            default:
                return $this->redirectToRoute("admin_login");
        }
        return $this->render("admin/pending_students.html.twig",[
            "records" => $record
        ]);
    }

    /**
     * @Route("/admin/approved",name="admin_approved_students", methods={"get"})
     * @param Session $session
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function approvedStudents(Session $session){
        if(!$session->has("admin")){
            return $this->redirectToRoute("admin_login");
        }
        $admin = new Admin();
        $admin->unserialize($session->get("admin"));
        $record = null;
        switch ($admin->getUnit()){
            case "AdminUnit":
                $record = $this->getDoctrine()
                    ->getRepository(AdminUnit::class)
                    ->findBy(["approve" => 1]);
                break;
            case "HealthService":
                $record = $this->getDoctrine()
                    ->getRepository(HealthService::class)
                    ->findBy(["approve" => 1]);
                break;
            case "ExamsAndRecords":
                $record = $this->getDoctrine()
                    ->getRepository(ExamsAndRecords::class)
                    ->findBy(["approve" => 1]);
                break;
            case "Faculty":
                $record = $this->getDoctrine()
                    ->getRepository(Faculty::class)
                    ->findBy(["approve" => 1]);
                break;
            case "StudentAffairs":
                $record = $this->getDoctrine()
                    ->getRepository(StudentAffairs::class)
                    ->findBy(["approve" => 1]);
                break;
            default:
                return $this->redirectToRoute("admin_login");
        }
        return $this->render("admin/approved_students.html.twig",[
            "records" => $record
        ]);
    }

    /**
     * @Route("/admin/student/{id}",name="admin_view_student", methods={"get"})
     * @param Session $session
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function viewStudent(Session $session, int $id){
        if(!$session->has("admin")){
            return $this->redirectToRoute("admin_login");
        }
        $admin = new Admin();
        $admin->unserialize($session->get("admin"));
        $student = $this->getDoctrine()->getRepository(Student::class)->find($id);
        $record = null;
        switch ($admin->getUnit()){
            case "AdminUnit":
                $record = $student->getAdminUnit();
                break;
            case "HealthService":
                $record = $student->getHealthService();
                break;
            case "ExamsAndRecords":
                $record = $student->getExamsAndRecords();
                break;
            case "Faculty":
                $record = $student->getFaculty();
                break;
            case "StudentAffairs":
                $record = $student->getStudentAffairs();
                break;
            default:
                return $this->redirectToRoute("admin_login");
        }
        return $this->render("admin/view_student.html.twig",[
           "unit" => $admin->getUnit(),
            "record" => $record
        ]);
    }

    /**
     * @Route("/admin/download/{fileName}", name="admin_result_download", methods={"get"})
     * @param $fileName
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadResult($fileName){
        return $this->file("uploads/".$fileName);
    }

    /**
     * @Route("/admin/approve/{id}", name="admin_approve", methods={"get"})
     * @param int $id
     * @param Session $session
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function approveStudent(int $id, Session $session){
        if(!$session->has("admin")){
            return $this->redirectToRoute("admin_login");
        }
        $admin = new Admin();
        $admin->unserialize($session->get("admin"));
        $record = null;
        $em = $this->getDoctrine()->getManager();
        switch ($admin->getUnit()){
            case "AdminUnit":
                $record = $em->getRepository(AdminUnit::class)->find($id);
                $record->setApprove(1);
                $em->flush();
                break;
            case "HealthService":
                $record = $em->getRepository(HealthService::class)->find($id);
                $record->setApprove(1);
                $em->flush();
                break;
            case "ExamsAndRecords":
                $record = $em->getRepository(ExamsAndRecords::class)->find($id);
                $record->setApprove(1);
                $em->flush();
                break;
            case "Faculty":
                $record = $em->getRepository(Faculty::class)->find($id);
                $record->setApprove(1);
                $em->flush();
                break;
            case "StudentAffairs":
                $record = $em->getRepository(StudentAffairs::class)->find($id);
                $record->setApprove(1);
                $em->flush();
                break;
            default:
                return $this->redirectToRoute("admin_login");
        }
        return $this->redirectToRoute("admin_view_students");
    }

}
