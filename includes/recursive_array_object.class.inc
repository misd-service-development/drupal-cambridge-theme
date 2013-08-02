<?php

/**
 * An instance of {@link ArrayObject} that also stores nested arrays as
 * instances of the same class.
 */
class RecursiveArrayObject extends ArrayObject {
  /**
   * {@inheritdoc}
   */
  public function __construct(array $array) {
    foreach ($array as $key => $value) {
      if (is_array($value)) {
        $value = new static($value);
      }
      $this->offsetSet($key, $value);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getArrayCopy() {
    $array = array();

    foreach (parent::getArrayCopy() as $key => $value) {
      if ($value instanceof ArrayObject) {
        $value = $value->getArrayCopy();
      }

      $array[$key] = $value;
    }

    return $array;
  }
}
