<?php


class selectMenu {
    private $items;  // array of items.
    private $values;
    private $options; // hold all html options
    private $selectMenu; // final select menu

    function __construct($itemArray='') {
        $this->items = $itemArray;
    }

    private function buildOptions($caption) {
        $this->options = "<option value=''>". $caption . "</option>";
        forEach($this->values as $value) {
            $this->options .= "<option value='"
                . $value->getSoilUID() . "'>"
                . $value->getSoilType() . "</option>";
        }
    }

    private function buildSelect($name) {
        $this->selectMenu = "<select name='". $name . "'>".$this->options."</select>";
    }

    public function setOptions($array) {
        $this->values = $array;
    }

    public function makeMenu($caption, $name) {
        $this->buildOptions($caption);
        $this->buildSelect($name);
        return $this->selectMenu;
    }
}
/*$myArray = ['Ms.','Mr.','Mrs.', 'Undetermined'];
    $myMenu = new selectMenu;
    $myMenu->setOptions($myArray);
    echo $myMenu->makeMenu("Select a Title", "Title");*/
?>