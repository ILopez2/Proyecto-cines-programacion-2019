<?php namespace dao;
    
    use models\Cinema as Cinema;
    use dao\Connection as Connection;
    
    interface InterfaceDao
    {
        public function readforID($id);
        public function readAll();
        public function add($obj);
        public function delete($id);
        public function edit();
    }
?>
