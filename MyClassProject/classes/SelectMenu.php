<?php


class selectMenu {
    private $items;  // array of items.
    private $options; // hold all html options
    private $selectMenu; // final select menu

    function __construct($itemArray='') {
        $this->items = $itemArray;
    }

    private function buildSOilOptions($caption, $values) {
        $this->options = "<option value=''>". $caption . "</option>";
        forEach($values as $value) {
            $this->options .= "<option value='"
                . $value->getSoilUID (). "'>"
                . $value->getSoilType() . "</option>";
        }
    }

    private function buildSelect($name) {
        $this->selectMenu = "<select name='". $name . "'>".$this->options."</select>";
    }

    public function setOptions($array) {
        $this->values = $array;
    }

    public function makeMenu($caption, $name, $values) {
        $this->buildSoilOptions($caption, $values);
        $this->buildSelect($name);
        return $this->selectMenu;
    }
}
