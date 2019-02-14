<?php declare(strict_types = 1);

namespace App\Model;

use Nextras\Orm\Entity\IEntity;
use Nextras\Orm\Entity\IPropertyContainer;
use Nextras\Orm\Entity\Reflection\PropertyMetadata;


class EmailProperty implements IPropertyContainer
{
	/** @var Email|NULL */
	private $value;

	/** @var IEntity */
	private $entity;

	/** @var PropertyMetadata */
	private $propertyMetadata;


	public function __construct(IEntity $entity, PropertyMetadata $propertyMetadata)
	{
		$this->entity = $entity;
		$this->propertyMetadata = $propertyMetadata;
	}


	public function loadValue(array $values) {
		$this->setRawValue($values[$this->propertyMetadata->name]);
	}


	public function saveValue(array $values): array {
		$values[$this->propertyMetadata->name] = $this->getRawValue();

		return $values;
	}

	public function setRawValue($value)
	{
		if ($value) {
			$this->value = new Email($value);
		} else {
			$this->value = NULL;
		}
	}


	public function getRawValue()
	{
		return $this->value ? $this->value->getEmail() : NULL;
	}


	public function &getInjectedValue()
	{
		return $this->value;
	}


	public function hasInjectedValue(): bool
	{
		return $this->value !== NULL;
	}


	public function setInjectedValue($value)
	{
		if ($this->value !== $value) {
			$this->entity->setAsModified($this->propertyMetadata->name);
		}
		$this->value = $value;
	}

}
