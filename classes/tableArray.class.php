<?php
//Table Class that we developed in one of our first assignments 
class tableArray {
	protected $html;
	public function getHTML($array){
		$this->getArray($array);
	 	return $this->html;
  }
  public function getArray(array $array) {
		$this->html = '<table id="table">';
		$this->html .= '<tr>';
		$first = true;
		foreach($array[0] as $key=>$value){
			$this->html .= '<th>' . $value . '</th>';
		}
		$this->html .= '</tr>';
		foreach($array as $key=>$value) {
	 	  if($first) {
		    $first = false;
		    continue;
		  }
		  $this->html .= '<tr>';
		  foreach($value as $key2=>$value2){
		    $this->html .= '<td>' . $value2 . '</td>';
		  }
		  $this->html .= '</tr>';
	  }
	  $this->html .= '</table>';
	  return $this->html;
	}
}


?>
