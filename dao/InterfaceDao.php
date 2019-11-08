<?php namespace dao;
    
    use models\Cinema as Cinema;
    use dao\Connection as Connection;
    
    interface InterfaceDao
    {
        public function getForID($id);
        public function getAll();
        public function add($obj);
        public function delete($id);
        public function edit($obj);
    }
?>
