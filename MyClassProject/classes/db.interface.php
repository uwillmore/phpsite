<?php

interface db_interface {
  
  public function connect();
  public function query($query);
  public function insert($query);
  public function select($query);
  public function error();
  public function quote($value);
}
