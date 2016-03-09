<?php

namespace AppBundle\Form\Type;
use AppBundle\Form\DataTransformer\TagDataTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
 public function buildForm(
 FormBuilderInterface $builder, array $options
 ) {
 $em = $options['em'];
 $trans = new TagDataTransformer($em);

 $builder
 ->add('name')
 ->add('notes')
 ->add('due_date')
 ->add(
 	$builder
 		->create('tags', 'text')
	        ->addModelTransformer($trans)
 )
 ->add('add', 'submit', [
       'label' => 'Add Task', 
       'attr' => ['class' => 'ui primary button']
  ]);

 }

 public function configureOptions(OptionsResolver $resolver)

 {

 $resolver->setDefaults([
 'data_class' => 'AppBundle\Entity\Task',
 ])
->setRequired(['em'])
->setAllowedTypes('em', 'Doctrine\ORM\EntityManager');

 }

 public function getName()

 {
 return 'task';
 }

}

?>
