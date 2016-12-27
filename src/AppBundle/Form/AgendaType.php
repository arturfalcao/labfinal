<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AgendaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title','text', array('label' => 'Nome do Evento'))
            ->add('morada','text', array('label' => 'Onde'))
            ->add('descricao','textarea', array('label' => 'Descrição'))
            ->add('startdatetime', 'datetime', array('label'=>'Data de inicio','date_widget' => "single_text",'time_widget' => "single_text",
                ))
            ->add('enddatetime', 'datetime', array('label'=>'Data de fim','date_widget' => "single_text", 'time_widget' => "single_text"))

            ->add('allDay','checkbox', array('label' => 'Todo o dia?'))

        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Agenda'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'Agenda';
    }
}
