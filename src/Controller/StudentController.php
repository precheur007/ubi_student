<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Student;
use App\Service\StudentService;

class StudentController extends AbstractController
{
    
    /**
     * @Route(
     *     name="student_avggrades",
     *     path="api/students/{id}/avggrades",
     *     methods={"GET"},
     *     defaults={
     *       "_controller"="\App\Controller\StudentController::studentAvgGrades",
     *       "_api_resource_class"="App\Entity\Student",
     *       "_api_item_operation_name"="studentAvgGrades"
     *     }
     *   )
     */
    public function studentAvgGrades($id = 'all', StudentService $studentService) {
		if($id == 'all') {
			$students = $this->getDoctrine()->getRepository('App:Student')->findAll();
			$gradesAvg = $studentService->classroomAvgGrades($students);
			$arrayResult = ['avg_grades' => $gradesAvg];
		} else {
			$student = $this->getDoctrine()->getRepository('App:Student')->find($id);
			$gradesAvg = $studentService->studentAvgGrades($student);
			$arrayResult = [
				'id' => $student->getId(),
				'student' => $student->getFirstname().' '.$student->getName(),
				'avg_grades' => $gradesAvg
			];
		}
		return $this->json($arrayResult);
    }

}
