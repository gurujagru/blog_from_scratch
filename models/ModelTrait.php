<?php
namespace blog\models;
use blog\core\Db;

trait ModelTrait
{

    public function save()
    {
        if(isset($this->id)){
            $this->update();
        } else {
            $this->insert();
        }
    }
    protected function insert()
    {
        $db = Db::getConnection();
        $properties = get_object_vars($this);

        $attributes = [];
        $params = [];

        foreach ($properties as $property => $value) {
            $attributes [] = $property;
            $params [] = ":{$property}";
        }

        $stmt = $db->prepare('INSERT into ' . self::table() . ' (' . implode(', ', $attributes) . ') VALUES(' . implode(',', $params) . ')');
        foreach ($properties as $property => $value) {
            $stmt->bindValue(":{$property}", $value);
        }
        $stmt->execute();
        return true;
    }

    protected function update()
    {
        $db = Db::getConnection();
        $properties = get_object_vars($this);
        unset($properties['id']);
        $columns = [];
        foreach ($properties as $property=>$value) {
            $columns [] = "{$property} = :{$property}";
        }
        $stmt = $db->prepare('UPDATE ' . self::table() . ' SET ' . implode(', ',$columns) . ' WHERE id = :id');
        foreach ($properties as $property=>$value) {
            $stmt->bindValue(":{$property}",$value);
        }
        $stmt->bindValue(':id',$this->id);
        $stmt->execute();
    }

    public static function delete(array $attributes)
    {
        $db = Db::getConnection();
        $data = [];
        foreach ($attributes as $attribute=>$value) {
            $data [] = ":{$attribute} = $attribute";
        }
        $stmt = $db->prepare('DELETE FROM ' . self::table() . ' WHERE ' . implode('AND ',$data));
        foreach ($attributes as $attribute=>$value) {
            $stmt->bindValue(":{$attribute}",$value);
        }
        $stmt->execute();
    }
}