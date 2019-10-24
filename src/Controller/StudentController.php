<?php

namespace App\Controller;

use App\Entity\AdminUnit;
use App\Entity\Exam;
use App\Entity\ExamsAndRecords;
use App\Entity\Faculty;
use App\Entity\HealthService;
use App\Entity\Jamb;
use App\Entity\Student;
use App\Entity\StudentAffairs;
use App\Form\AdminUnitType;
use App\Form\ExamsAndRecordsType;
use App\Form\ExamType;
use App\Form\FacultyType;
use App\Form\HealthServiceType;
use App\Form\JambType;
use App\Form\StudentAffairsType;
use App\Form\StudentRegisterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    /**
     * @Route("/dashboard", name="student_dashboard")
     * @param Session $session
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function dashboard(Session $session){
        if(!$session->has("student")){
            return $this->redirectToRoute("student_login");
        }
        $count = 0;
        $approved = 0;
        $student = new Student();
        $student->unserialize($session->get("student"));
        $student = $this->getDoctrine()->getRepository(Student::class)->find($student->getId());
        $count = $student->getAdminUnit() !== null ?$count + 1:$count;
        $approved = !is_null($student->getAdminUnit()) && $student->getAdminUnit()->getApprove()?$approved + 1:$approved;
        if(!is_null($student->getAdminUnit())){
            $count = !is_null($student->getAdminUnit()->getExams())?$count + 1:$count;
            $count = !is_null($student->getAdminUnit()->getJamb())?$count + 1:$count;
        }
        $approved = !is_null($student->getHealthService())?$approved + 1:$approved;
        $approved = !is_null($student->getFaculty())?$approved + 1:$approved;
        $approved = !is_null($student->getStudentAffairs())?$approved + 1:$approved;
        $approved = !is_null($student->getExamsAndRecords())?$approved + 1:$approved;
        $approved = $approved == 5?true:false;
        $count = !is_null($student->getHealthService()) && $student->getHealthService()->getApprove()?$count + 1:$count;
        $count = !is_null($student->getFaculty()) && $student->getFaculty()->getApprove()?$count + 1:$count;
        $count = !is_null($student->getStudentAffairs()) && $student->getStudentAffairs()->getApprove()?$count + 1:$count;
        $count = !is_null($student->getExamsAndRecords()) && $student->getExamsAndRecords()->getApprove()?$count + 1:$count;
        $count = round(($count/7) * 100);
        return $this->render("student/dashboard.html.twig",[
            "percentage" => $count,
            "approved" => $approved
        ]);
    }

    /**
     * @Route("/logout", name="student_logout")
     * @param Session $session
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function logout(Session $session){
        $session->remove("student");
        $session->clear();
        return $this->redirectToRoute("student_login");
    }

    /**
     * @Route("/exam", name="student_add_exam")
     * @param Request $request
     * @param Session $session
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addExam(Request $request, Session $session){
        if(!$session->has("student")){
            return $this->redirectToRoute("student_login");
        }
        $exam = new Exam();
        $form = $this->createForm(ExamType::class, $exam);
        $form->handleRequest($request);
        $student = new Student();
        $student->unserialize($session->get("student"));
        $em = $this->getDoctrine()->getManager();
        $student = $em->getRepository(Student::class)->find($student->getId());
        $exist = is_null($student->getAdminUnit())?false:!$student->getAdminUnit()->getExams()->isEmpty();
        if($form->isSubmitted() && $form->isValid()){
          $file = new File($exam->getResult());
          $fileName = md5(uniqid()).'('.$student->getMatricNumber().').'.$file->guessExtension();
          if($file->move("uploads",$fileName)){
              $exam->setResult($fileName);
              $exam->setAdminUnit($student->getAdminUnit());
              $exam->setAddedDate(new \DateTime("now"));
              $em->persist($student->getAdminUnit());
              $em->persist($exam);
              $em->flush();
          }

        }
        return $this->render("student/add_exam.html.twig",[
            "form"=>$form->createView(),
            "exist" => $exist
        ]);
    }

    /**
     * @Route("/jamb", name="student_add_jamb")
     * @param Request $request
     * @param Session $session
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addJamb(Request $request, Session $session){
        if(!$session->has("student")){
            return $this->redirectToRoute("student_login");
        }
        $em = $this->getDoctrine()->getManager();
        $student = new Student();
        $student->unserialize($session->get("student"));
        $student = $em->getRepository(Student::class)->find($student->getId());
        $jamb = is_null($student->getAdminUnit()->getJamb())?new Jamb():$student->getAdminUnit()->getJamb();
        $form = $this->createForm(JambType::class,$jamb);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
           $jamb->setAddedDate(new \DateTime("now"));
           $student->getAdminUnit()->setJamb($jamb);
           $em->persist($jamb);
           $em->persist($student->getAdminUnit());
           $em->flush();
           return $this->redirectToRoute("student_health_service");
        }
        return $this->render("student/add_jamb.html.twig",[
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/admin-unit", name="student_admin_unit")
     * @param Request $request
     * @param Session $session
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function adminUnit(Request $request, Session $session){
        if(!$session->has("student")){
            return $this->redirectToRoute("student_login");
        }
        $student = new Student();
        $student->unserialize($session->get("student"));
        $em = $this->getDoctrine()->getManager();
        $student = $em->getRepository(Student::class)->find($student->getId());
        $adminUnit = is_null($student->getAdminUnit())?new AdminUnit():$student->getAdminUnit();
        $form = $this->createForm(AdminUnitType::class, $adminUnit);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $adminUnit->setStudent($student);
            $adminUnit->setApprove(0);
            $em->persist($adminUnit);
            $em->persist($student);
            $em->flush();
            return $this->redirectToRoute("student_add_exam");
        }
        return $this->render("student/admin_unit.html.twig",["form"=>$form->createView()]);
    }

    /**
     * @Route("/health_service", name="student_health_service")
     * @param Request $request
     * @param Session $session
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function healthService(Request $request, Session $session){
        if(!$session->has("student")){
            return $this->redirectToRoute("student_login");
        }
        $healthService = new HealthService();
        $form = $this->createForm(HealthServiceType::class,$healthService);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $student = new Student();
        $student->unserialize($session->get("student"));
        $student = $em->getRepository(Student::class)->find($student->getId());
        $exist = is_object($student->getHealthService());
        if($form->isSubmitted() && $form->isValid()){
            $xRay = new File($healthService->getXRay());
            $labTest = new File($healthService->getLabTest());

            if(!is_null($em->getRepository(HealthService::class)->findOneBy(["student"=>$student] ))){
                $form->addError(new FormError("Oops! you've already submitted your receipt, and cannot submit new receipt."));
                return $this->render("student/student_affairs.html.twig",[
                    "form" => $form->createView()
                ]);
            }
            $xRayName = md5(uniqid())."(".$student->getMatricNumber().").".$xRay->guessExtension();
            $labTestName = md5(uniqid())."(".$student->getMatricNumber().").".$labTest->guessExtension();
            if($xRay->move("uploads",$xRayName) && $labTest->move("uploads",$labTestName)){
                $healthService->setStudent($student);
                $healthService->setLabTest($labTestName);
                $healthService->setXRay($xRayName);
                $healthService->setAddedDate(new \DateTime("now"));
                $healthService->setApprove(0);
                $em->persist($healthService);
                $em->persist($student);
                $em->flush();
                return $this->redirectToRoute("student_faculty");
            }
        }
        return $this->render("student/health_service.html.twig",[
            "form" => $form->createView(),
            "exist" => $exist
        ]);
    }

    /**
     * @Route("/faculty", name="student_faculty")
     * @param Request $request
     * @param Session $session
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function faculty(Request $request, Session $session){
        if(!$session->has("student")){
            return $this->redirectToRoute("student_login");
        }
        $faculty = new Faculty();
        $form = $this->createForm(FacultyType::class,$faculty);
        $form->handleRequest($request);
        $student = new Student();
        $student->unserialize($session->get("student"));
        $em = $this->getDoctrine()->getManager();
        $student = $em->getRepository(Student::class)->find($student->getId());
        $exist = is_object($student->getFaculty());
        if($form->isSubmitted() && $form->isValid()){
            $prospectus = new File($faculty->getProspectus());
            $due = new File($faculty->getDue());
            $gown = new File($faculty->getMatricGown());
            $prospectusName = md5(uniqid())."(".$student->getMatricNumber().").".$prospectus->guessExtension();
            $dueName = md5(uniqid())."(".$student->getMatricNumber().").".$due->guessExtension();
            $gownName = md5(uniqid())."(".$student->getMatricNumber().").".$gown->guessExtension();
            if($prospectus->move("uploads",$prospectusName) && $due->move("uploads",$dueName)
            && $gown->move("uploads",$gownName)){
                $faculty->setStudent($student);
                $faculty->setAddedDate(new \DateTime("now"));
                $faculty->setDue($dueName);
                $faculty->setProspectus($prospectusName);
                $faculty->setMatricGown($gownName);
                $faculty->setApprove(0);
                $em->persist($faculty);
                $em->persist($student);
                $em->flush();
                return $this->redirectToRoute("student_affairs");
            }
        }
        return $this->render("student/faculty.html.twig",[
            "form" => $form->createView(),
            "exist" => $exist
        ]);
    }

    /**
     * @Route("/student_affairs", name="student_affairs")
     * @param Request $request
     * @param Session $session
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function studentAffairs(Request $request, Session $session){
        if(!$session->has("student")){
            return $this->redirectToRoute("student_login");
        }
        $studentAffairs = new StudentAffairs();
        $form = $this->createForm(StudentAffairsType::class,$studentAffairs);
        $form->handleRequest($request);
        $student = new Student();
        $student->unserialize($session->get("student"));
        $em = $this->getDoctrine()->getManager();
        $student = $em->getRepository(Student::class)->find($student->getId());
        $exist = is_object($student->getStudentAffairs());
        if($form->isSubmitted() && $form->isValid()){
            if(!is_null($em->getRepository(StudentAffairs::class)->findOneBy(["student"=>$student] ))){
                $form->addError(new FormError("Oops! you've already submitted your receipt, and cannot submit new receipt."));
                return $this->render("student/student_affairs.html.twig",[
                    "form" => $form->createView()
                ]);
            }
            $handbook = new File($studentAffairs->getHandbook());
            $aauaCd = new File($studentAffairs->getAauaCd());
            $mobilePlatform = new File($studentAffairs->getMobilePlatform());
            $handbookName = md5(uniqid())."(".$student->getMatricNumber().").".$handbook->guessExtension();
            $aauaCdName = md5(uniqid())."(".$student->getMatricNumber().").".$aauaCd->guessExtension();
            $mobilePlatformName = md5(uniqid())."(".$student->getMatricNumber().").".$mobilePlatform->guessExtension();
            if($handbook->move("uploads",$handbookName) && $aauaCd->move("uploads",$aauaCdName)
                && $mobilePlatform->move("uploads",$mobilePlatformName)) {
                $studentAffairs->setStudent($student);
                $studentAffairs->setAddedDate(new \DateTime("now"));
                $studentAffairs->setHandbook($handbookName);
                $studentAffairs->setAauaCd($aauaCdName);
                $studentAffairs->setMobilePlatform($mobilePlatformName);
                $studentAffairs->setApprove(0);
                $em->persist($studentAffairs);
                $em->persist($student);
                $em->flush();
                return $this->redirectToRoute("student_exams&records");
            }
        }
        return $this->render("student/student_affairs.html.twig",[
            "form" => $form->createView(),
            "exist" => $exist
        ]);
    }

    /**
     * @Route("/exams&records", name="student_exams&records")
     * @param Request $request
     * @param Session $session
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function examsAndRecords(Request $request, Session $session){
        if(!$session->has("student")){
            return $this->redirectToRoute("student_login");
        }
        $examsAndRecords = new ExamsAndRecords();
        $form = $this->createForm(ExamsAndRecordsType::class,$examsAndRecords);
        $form->handleRequest($request);
        $student = new Student();
        $student->unserialize($session->get("student"));
        $em = $this->getDoctrine()->getManager();
        $student = $em->getRepository(Student::class)->find($student->getId());
        $exist = is_object($student->getExamsAndRecords());
        if($form->isSubmitted() && $form->isValid()){
            $jambLetter = new File($examsAndRecords->getJambLetter());
            $aauaLetter = new File($examsAndRecords->getAauaLetter());
            $birthCertificate = new File($examsAndRecords->getBirthCertificate());
            $stateOfOrigin = new File($examsAndRecords->getStateOfOrigin());
            $attestationLetter = new File($examsAndRecords->getAttestationLetter());
            $jambResult = new File($examsAndRecords->getJambResult());
            $fileNames = [];
            $fileNames[] = md5(uniqid())."(".$student->getMatricNumber().").".$jambLetter->guessExtension();
            $fileNames[] = md5(uniqid())."(".$student->getMatricNumber().").".$aauaLetter->guessExtension();
            $fileNames[] = md5(uniqid())."(".$student->getMatricNumber().").".$birthCertificate->guessExtension();
            $fileNames[] = md5(uniqid())."(".$student->getMatricNumber().").".$stateOfOrigin->guessExtension();
            $fileNames[] = md5(uniqid())."(".$student->getMatricNumber().").".$attestationLetter->guessExtension();
            $fileNames[] = md5(uniqid())."(".$student->getMatricNumber().").".$jambResult->guessExtension();
            if($jambLetter->move("uploads",$fileNames[0]) && $aauaLetter->move("uploads",$fileNames[1])
                && $birthCertificate->move("uploads",$fileNames[2]) && $stateOfOrigin->move("uploads",$fileNames[3])
            && $attestationLetter->move("uploads",$fileNames[4]) && $jambResult->move("uploads",$fileNames[5])) {
                $examsAndRecords->setStudent($student);
                $examsAndRecords->setAddedDate(new \DateTime("now"));
                $examsAndRecords->setJambLetter($fileNames[0]);
                $examsAndRecords->setAauaLetter($fileNames[1]);
                $examsAndRecords->setBirthCertificate($fileNames[2]);
                $examsAndRecords->setStateOfOrigin($fileNames[3]);
                $examsAndRecords->setAttestationLetter($fileNames[4]);
                $examsAndRecords->setJambResult($fileNames[5]);
                $examsAndRecords->setApprove(0);
                $em->persist($examsAndRecords);
                $em->persist($student);
                $em->flush();
                return $this->redirectToRoute("student_exams&records");
            }
        }
        return $this->render("student/exams_and_records.html.twig",[
            "form" => $form->createView(),
            "exist" => $exist
        ]);
    }

    /**
     * @Route("/", name="student_login")
     * @param Request $request
     * @param Session $session
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function login(Request $request, Session $session){
        if($session->has("student")){
            return $this->redirectToRoute("student_dashboard");
        }
        $form = $this->createFormBuilder()
            ->add('matric_number', TextType::class,[
            "attr"=>["placeholder" => "e.g: 14xxxxxxx", "class" => "form-control1"],
            "label" => "Matric Number/Jamb Reg."])
            ->add('password', PasswordType::class,[
                "attr"=>["placeholder" => "e.g: minimum of 8 characters", "class" => "form-control1"]])
        ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $student = $this->getDoctrine()->getRepository(Student::class)
                ->findOneBy(["matric_number" => $form->getData()["matric_number"]]);
            if(is_null($student)){
                $form->addError(new FormError("Invalid Jamb Reg/Matric Numnber"));
                return $this->render("student/login.html.twig",[
                    "form" => $form->createView()
                ]);
            }else if(password_verify($form->getData()["password"],$student->getPassword())){
                $session->set("student", $student->serialize());
                return $this->redirectToRoute("student_dashboard");
            }else{
                $form->addError(new FormError("Invalid Password"));
                return $this->render("student/login.html.twig",[
                    "form" => $form->createView()
                ]);
            }
        }
        return $this->render("student/login.html.twig",[
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/register", name="student_register")
     * @param Request $request
     * @param Session $session
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function register(Request $request, Session $session){
        $student = new Student();
        $form = $this->createForm(StudentRegisterType::class,$student);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            if($student->getPassword() != $student->getConfirmPassword()){
                $form->addError(new FormError("Oops! mismatched password"));
                return $this->render("student/register.html.twig",["form"=>$form->createView()]);
            }
            $student->setRegisteredDate(new \DateTime("now"));
            $student->setPassword($student->getHashedPassword());
            $em = $this->getDoctrine()->getManager();
            $em->persist($student);
            $em->flush();
            $session->set("student", $student->serialize());
            return $this->redirectToRoute("student_dashboard");
        }
        return $this->render("student/register.html.twig",["form"=>$form->createView()]);
    }
}
