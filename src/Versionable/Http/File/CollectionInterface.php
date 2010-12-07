<?php

namespace Versionable\Http\File;

interface CollectionInterface {
  public function __toString();  

  public function add(FileInterface $parameter);

  public function remove($name);

  public function get($name);

  public function has($name);

  public function toString();
  
  public function toArray();
}
