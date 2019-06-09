<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;

class ApplicationType extends AbstractType
{
    /**
     * Permet d'avoir la configuration de base d'un champ !
     *
     * @param $label
     * @param $placeholder
     * @param bool $required
     * @return array
     */
    protected function getConfiguration($label, $placeholder, $required = TRUE){
        return [
            'label' => $label,
            'attr' => [
                'placeholder' => $placeholder
            ],
            'required' => $required
        ];
    }
}
