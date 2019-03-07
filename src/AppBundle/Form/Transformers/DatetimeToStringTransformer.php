<?php
namespace AppBundle\Form\Transformers;

use Symfony\Component\Form\DataTransformerInterface;

class DatetimeToStringTransformer implements DataTransformerInterface
{
    public function transform($dob)
    {
        if (null === $dob) {
            return '';
        }

        return $dob->format('Y-m-d');
    }

    public function reverseTransform($dob)
    {
        if ($dob === "") {
            return null;
        }

        return \DateTime::createFromFormat('Y-m-d',$dob);
    }
}