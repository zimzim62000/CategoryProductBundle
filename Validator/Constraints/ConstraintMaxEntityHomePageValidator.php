<?php

namespace ZIMZIM\CategoryProductBundle\Validator\Constraints;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ConstraintMaxEntityHomePageValidator extends ConstraintValidator
{
    private $entityManager;
    private $maxHomePage;

    public function __construct(EntityManager $entityManager, $maxHomePage)
    {
        $this->entityManager = $entityManager;
        $this->maxHomePage = $maxHomePage;
    }

    public function validate($object, Constraint $constraint)
    {
        if ($object->getHomepage() === true) {

            $id = $object->getId();

            $countProduct = $this->entityManager->getRepository(
                'ZIMZIMCategoryProductBundle:Product'
            )->getCountProductHomepage($id);

            $countCategory = $this->entityManager->getRepository(
                'ZIMZIMCategoryProductBundle:Category'
            )->getCountCategoryHomepage($id);

            $nbHomePage = intval($countCategory + $countProduct);

            if ($nbHomePage >= $this->maxHomePage) {
                $this->context->addViolation($constraint->message, array('%number%' => $nbHomePage));
            }
        }
    }
}