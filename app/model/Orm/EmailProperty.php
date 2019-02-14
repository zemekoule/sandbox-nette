<?php declare(strict_types = 1);

namespace App\Model;

use Nextras\Orm\Entity\IEntity;
use Nextras\Orm\Entity\IPropertyContainer;
use Nextras\Orm\Entity\Reflection\PropertyMetadata;


class EmailProperty implements IPropertyContainer
{
	/** @var Email|NULL */
	private $value;

	/** @var PropertyMetadata */
	private $propertyMetadata;


	public function __construct(PropertyMetadata $propertyMetadata)
	{
		$this->propertyMetadata = $propertyMetadata;
	}


	/**
	 * @param \Nextras\Orm\Entity\IEntity $entity
	 * @param array $values
	 * @internal
	 *
	 * @throws \Nette\Utils\AssertionException
	 */
	public function loadValue(IEntity $entity, array $values): void {
		$this->setRawValue($values[$this->propertyMetadata->name]);
	}

	/**
	 * @internal
	 *
	 * @param \Nextras\Orm\Entity\IEntity $entity
	 * @param array $values
	 *
	 * @return array
	 */
	public function saveValue(IEntity $entity, array $values): array {
		$values[$this->propertyMetadata->name] = $this->getRawValue();

		return $values;
	}

	/**
	 * @param mixed $value
	 *
	 * @throws \Nette\Utils\AssertionException
	 */
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


	/**
	 * @param \Nextras\Orm\Entity\IEntity $entity
	 * @internal
	 *
	 * @return \App\Model\Email|mixed|NULL
	 */
	public function &getInjectedValue(IEntity $entity)
	{
		return $this->value;
	}


	/**
	 * @param \Nextras\Orm\Entity\IEntity $entity
	 * @internal
	 * @return bool
	 */
	public function hasInjectedValue(IEntity $entity): bool
	{
		return $this->value !== NULL;
	}


	/**
	 * @param \Nextras\Orm\Entity\IEntity $entity
	 * @param mixed $value
	 * @internal
	 */
	public function setInjectedValue(IEntity $entity, $value)
	{
		if ($this->value !== $value) {
			$entity->setAsModified($this->propertyMetadata->name);
		}
		$this->value = $value;
	}



	/**
	 * @internal
	 *
	 * @param  \App\Model\Email|null $value
	 *
	 * @return string
	 */
	public function convertToRawValue($value): ?string {
		if ($value instanceof Email) {
			return (string) $value;
		}

		return $value;
	}

}
