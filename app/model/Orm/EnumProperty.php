<?php declare(strict_types=1);

namespace App\Model;

use MabeEnum\Enum;
use Nextras\Orm\Entity\IEntity;
use Nextras\Orm\Entity\IPropertyContainer;
use Nextras\Orm\Entity\Reflection\PropertyMetadata;


class EnumProperty implements IPropertyContainer {
	/** @var Enum|NULL */
	private $value;

	/** @var IEntity */
	private $entity;

	/** @var PropertyMetadata */
	private $propertyMetadata;

	/** @var string */
	private $enumClass;

	public function __construct(IEntity $entity, PropertyMetadata $propertyMetadata) {
		$this->entity = $entity;
		$this->propertyMetadata = $propertyMetadata;
		$this->enumClass = key($this->propertyMetadata->types);
		assert(class_exists($this->enumClass));
	}

	public function loadValue(array $values) {
		$this->setRawValue($values[$this->propertyMetadata->name]);
	}


	public function saveValue(array $values): array {
		$values[$this->propertyMetadata->name] = $this->getRawValue();

		return $values;
	}

	public function setRawValue($value) {
		if($value) {
			$class = $this->enumClass;
			$this->value = $class::byValue($value);
		} else {
			$this->value = null;
		}
	}


	public function getRawValue() {
		return $this->value ? $this->value->getValue() : null;
	}


	public function &getInjectedValue() {
		return $this->value;
	}


	public function hasInjectedValue(): bool {
		return $this->value !== null;
	}


	public function setInjectedValue($value) {
		if($this->value !== $value) {
			$this->entity->setAsModified($this->propertyMetadata->name);
		}
		$this->value = $value;
	}

}
