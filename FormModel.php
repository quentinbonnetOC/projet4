<?php
/**
 * Class Form
 * Permet de générer le formulaire de connection au backoffice
 */
class Form{
     /**
     * @param $index string Index de la valeur à récupérer
     * @return string
     */
    private function getValue($index){
        return isset($this->data[$index]) ? $this->data[$index] : null;
    }
     /**
     * @param $name string
     * @return string
     */
    public function input($name, $type, $id, $value){
        return '<input id="'.$id.'" type="'.$type.'" name="'.$name.'" value="'.$value.'">';
    } 
     /**
     * @return string
     */
    public function submit($id){
        return '<button id="'.$id.'" type="submit">Envoyer</button>'
        ;
    }
    public function label($name){
        return '<label for="'.$name.'">'.$name.'</label>';
    }
    public function checkbox($name, $id, $value, $checked){
        return '<input id="'.$id.'" type="checkbox" name="'.$name.'" value="'.$value.'" '.$checked.'>';
    }
}
?>