<?php
class Company
{
  //プロパティ
  private $code;
  private $name;
  private $address;
  private $phone;
  private $labors;

  //メソッド
  public function __construct($code, $name, $address, $phone, $labors)
  {
    $this->code = $code;
    $this->name = $name;
    $this->address = $address;
    $this->phone = $phone;
    $this->labors = $labors;
  }

  public function get_code()
  {
    return $this->code;
  }

  public function get_name()
  {
    return $this->name;
  }

  public function get_address()
  {
    return $this->address;
  }

  public function get_phone()
  {
    return $this->phone;
  }

  public function get_labors()
  {
    return $this->labors;
  }
}
