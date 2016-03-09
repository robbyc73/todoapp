<?php

namespace AppBundle\Form\DataTransformer;

use AppBundle\Entity\Tag;

use Doctrine\ORM\EntityManager;

use Symfony\Component\Form\DataTransformerInterface;

class TagDataTransformer implements DataTransformerInterface

{

 /**
 * @var EntityManager
 */
 private $em;

 /**
 * @param EntityManager $em
 */
 public function __construct(EntityManager $em)

 {

 $this->em = $em;

 }

 /**
 * Transforms an objects (Tags) to a string.
 */
 public function transform($tags)

 {

 if (null === $tags) {

 return "";

 }

 $output = [];

 foreach ($tags as $tag) {

 $output[] = $tag->getName();

 }

 return join(', ', $output);

 }

 /**
 * Transforms a string to a tag.
 */
 public function reverseTransform($tags)

 {

 if (!$tags) {

 return [];

 }

 $output = [];

 $tagsArray = explode(',', $tags);

 foreach ($tagsArray as $name) {

 $name = trim($name);

 $tag = $this->em
 ->getRepository('AppBundle:Tag')
 ->findOneBy(array('name' => $name));

 if (!$tag) {

 $tag = new Tag();
 $tag->setName($name);
 $this->em->persist($tag);

 }

 $output[] = $tag;

 }

 return $output;

 }

}
