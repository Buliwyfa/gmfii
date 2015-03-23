<?
//
// EJsonBehavor extends from CBehavior
class Json extends CBehavior{
    //
    // this property will hold a reference to
    // its owner - the model class that will
    // have this behavior attached to it
    private $owner;
    //
    // this property will reference the
    // relations of the model class -owner
    private $relations;
    public function toJSON(){
        //
        // getting a reference to model class
        // having this behavior attached to it
        $this->owner = $this->getOwner();
        //
        // making sure it is a CActiveRecord descendant
        if (is_subclass_of($this->owner,'CActiveRecord')){
            //
            // play with it!
            //
            // get model attributes
            $attributes = $this->owner->getAttributes();
            //
            // if this model has related model classes
            // get them attributes
            $this->relations     = $this->getRelated();
            //
            // structure the to-be-converted JSON
            $jsonDataSource = array('jsonDataSource'=>array('attributes'=>$attributes,'relations'=>$this->relations));
            //
            // return the JSON result
            return CJSON::encode($jsonDataSource);
        }
        return false;
    }
    //
    // returns related model's attributes
    private function getRelated()
    {
        $related = array();
        $obj = null;
        $md=$this->owner->getMetaData();
        foreach($md->relations as $name=>$relation){
            $obj = $this->owner->getRelated($name);
            $related[$name] = $obj instanceof CActiveRecord ? $obj->getAttributes() : $obj;
        }
        return $related;
    }
} // end of class
?>
