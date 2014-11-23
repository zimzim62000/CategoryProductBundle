<?php

namespace ZIMZIM\CategoryProductBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ConstraintMaxEntityHomePage extends Constraint
{
    public $message = 'constaint.maxentityhomepage';


    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }

    public function validatedBy(){
        return 'zimzim_categoryproductbundle_maxentityhomepage';
    }
}