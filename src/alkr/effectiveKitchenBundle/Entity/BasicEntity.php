<?php
namespace alkr\effectiveKitchenBundle\Entity;

abstract class BasicEntity {
    public function setInverseSideDependencies()
    {
        $class = new \ReflectionClass(get_class($this));
        foreach ($this as $property => $propertyValue) {
            if ($propertyValue instanceof \Doctrine\ORM\PersistentCollection) {
                $setter = 'set'.$class->getShortName();
                foreach ($propertyValue->getValues() as $child) {
                    $child->$setter($this);
                    $child->setInverseSideDependencies();
                }
            }
            if ($propertyValue instanceof \Doctrine\Common\Collections\ArrayCollection) {
                $setter = 'set'.$class->getShortName();
                foreach ($propertyValue as $child) {
                    $child->$setter($this);
                    $child->setInverseSideDependencies();
                }
            }
        }
    }
}