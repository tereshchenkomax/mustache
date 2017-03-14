<?php


namespace widgets;

class MustacheWidget extends \WP_Widget
{
    public function __construct() {


        parent::__construct(
            "mustache_example",
            "Mustache  Example Widget",
            array("description" => "Example")
        );
    }

    /**
     * Метод form() используется для отображения настроек виджета на странице виджетов.
     * @param $instance
     */
    public function form($instance) {
        $title = "";
        $text = "";
        // если instance не пустой, достанем значения
        if (!empty($instance)) {
            $title = $instance["title"];
            $text = $instance["text"];
        }

        $tableId = $this->get_field_id("title");
        $tableName = $this->get_field_name("title");
        echo '<label for="' . $tableId . '">Title</label><br>';
        echo '<input id="' . $tableId . '" type="text" name="' .
            $tableName . '" value="' . $title . '"><br>';

        $textId = $this->get_field_id("text");
        $textName = $this->get_field_name("text");
        echo '<label for="' . $textId . '">Text</label><br>';
        echo '<textarea id="' . $textId . '" name="' . $textName .
            '">' . $text . '</textarea>';
    }

    /**
     * @param $newInstance
     * @param $oldInstance
     * @return array
     */

    public function update($newInstance, $oldInstance) {
        $values = array();
        $values["title"] = htmlentities($newInstance["title"]);
        $values["text"] = htmlentities($newInstance["text"]);
        return $values;
    }

    /**
     * @param $args
     * @param $instance
     */
    public function widget($args, $instance) {
        $title = $instance["title"];
        $text = $instance["text"];

        echo "<h2>$title</h2>";
        echo "<p>$text</p>";



    }


}