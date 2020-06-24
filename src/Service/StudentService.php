<?php 

namespace App\Service;

use App\Entity\Student;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class StudentService {
    public function studentAvgGrades(Student $student): float {
		$cGrades = $student->getGrades();
		$fGradeSum = 0;
		foreach($cGrades as $grade) {
			$fGradeSum += $grade->getValue();
		}
		return round($fGradeSum / $cGrades->count(), 2);
    }
	
	public function classroomAvgGrades(Collection $students): float {
		$aGrades = [];
        foreach ($students as $student) {
			$aGrades[] = $student->getGrades();
		}
		
		$fGradeSum = 0;
		foreach ($aGrades as $cGrades) {
			foreach($cGrades as $grade) {
				$fGradeSum += $grade->getValue();
			}
		}
		
		return round($fGradeSum / count($aGrades), 2);
    }
}