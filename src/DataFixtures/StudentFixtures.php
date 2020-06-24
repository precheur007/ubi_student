<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Student;
use App\Entity\Grade;
use App\Entity\Subject;

class StudentFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
		$aStudents = [ [ "name" => 'Petit', "firstname" => "Jean", "birthday" => "1990-05-01"],
					  [ "name" => 'Brown', "firstname" => "Alfonse", "birthday" => "1998-12-19"],
					  [ "name" => 'Wayne', "firstname" => "Bruce", "birthday" => "1980-01-24"],
					  [ "name" => 'Jackson', "firstname" => "Richardson", "birthday" => "1989-11-12"],
					  [ "name" => 'Douglas', "firstname" => "Michael", "birthday" => "1949-04-22"]	];
		
		//Create a subject
		$subject = new Subject();
		$subject->setName('Mathematics');
		$manager->persist($subject);
		foreach ($aStudents as $stud) {
			$student = new Student();
			$student->setName($stud['name']);
			$student->setFirstname($stud['firstname']);
			$student->setBirthday(new \DateTime($stud['birthday']));
			for ($i = 0; $i < 10; $i++) {
				$grade = new Grade();
				$grade->setValue($i * 2);
				$grade->setStudent($student);
				$grade->setSubject($subject);
				$manager->persist($grade);
			}
			$manager->persist($student);
		}
		$manager->flush();
    }
}
