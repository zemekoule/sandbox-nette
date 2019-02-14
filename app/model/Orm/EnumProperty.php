<?php declare(strict_types=1);

namespace App\Model;

use MabeEnum\Enum;
use Nextras\Orm\Entity\IEntity;
use Nextras\Orm\Entity\IPropertyContainer;
use Nextras\Orm\Entity\Reflection\PropertyMetadata;


class EnumProperty implements IPropertyContainer {
	/** @var Enum|NULL */
	private $value;

	/** @var PropertyMetadata */
	private $propertyMetadata;

	/** @var string */
	private $enumClass;

	public function __construct(PropertyMetadata $propertyMetadata) {
		$this->propertyMetadata = $propertyMetadata;
		$this->enumClass = key($this->propertyMetadata->types);
		assert(class_exists($this->enumClass));
	}

	/**
	 * @param \Nextras\Orm\Entity\IEntity $entity
	 * @param array $values
	 * @internal
	 */
	public function loadValue(IEntity $entity, array $values): void {
		$this->setRawValue($values[$this->propertyMetadata->name]);
	}


	/**
	 * @param \Nextras\Orm\Entity\IEntity $entity
	 * @param array $values
	 * @internal
	 * @return array
	 */
	public function saveValue(IEntity $entity, array $values): array {
		$values[$this->propertyMetadata->name] = $this->getRawValue();

		return $values;
	}

	/**
	 * @param mixed $value
	 */
	public function setRawValue($value) {
		if($value) {
			$class = $this->enumClass;
			$this->value = $class::byValue($value);
		} else {
			$this->value = null;
		}
	}


	/**
	 * @return array|bool|float|int|mixed|string|null
	 */
	public function getRawValue() {
		return $this->value ? $this->value->getValue() : null;
	}


	/**
	 * @param \Nextras\Orm\Entity\IEntity $entity
	 * @internal
	 *
	 * @return \MabeEnum\Enum|mixed|NULL
	 */
	public function &getInjectedValue(IEntity $entity) {
		return $this->value;
	}


	/**
	 * @param \Nextras\Orm\Entity\IEntity $entity
	 * @internal
	 *
	 * @return bool
	 */
	public function hasInjectedValue(IEntity $entity): bool {
		return $this->value !== null;
	}


	/**
	 * @param \Nextras\Orm\Entity\IEntity $entity
	 * @param mixed $value
	 * @internal
	 */
	public function setInjectedValue(IEntity $entity, $value) {
		if($this->value !== $value) {
			$entity->setAsModified($this->propertyMetadata->name);
		}
		$this->value = $value;
	}

	/**
	 * @internal
	 *
	 * @param  \MabeEnum\Enum|null $value
	 *
	 * @return string
	 */
	public function convertToRawValue($value): ?string {
		if ($value instanceof $this->enumClass) {
			return (string) $value;
		}

		return $value;
	}
}
