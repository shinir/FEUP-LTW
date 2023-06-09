<?php
  class Session {
    private array $messages;

    public function __construct() {
      session_set_cookie_params(0, '/', "", true, true);
      session_start();

      $this->messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : array();
      unset($_SESSION['messages']);
    }

    public function isLoggedIn() : bool {
      return isset($_SESSION['id']);    
    }

    public function logout() {
      session_destroy();
    }

    public function getImagePath() : ?string {
      return isset($_SESSION['path']) ? $_SESSION['path'] : null;    
    }

    public function getId() : ?int {
      return isset($_SESSION['id']) ? $_SESSION['id'] : null;    
    }

    public function getName() : ?string {
      return isset($_SESSION['name']) ? $_SESSION['name'] : null;
    }

    public function isCustomer() : bool {
      return isset($_SESSION['usertype']) ? 
        strcmp($_SESSION['usertype'], "customer") === 0 || strcmp($_SESSION['usertype'], "tester") === 0 : 
        false;
    }

    public function isOwner() : bool {
      return isset($_SESSION['usertype']) ? 
        strcmp($_SESSION['usertype'], "owner") === 0 || strcmp($_SESSION['usertype'], "tester") === 0 : 
        false;
    }

    public function setImagePath(string $path) {
      $_SESSION['path'] = $path;
    }
    
    public function setId(int $id) {
      $_SESSION['id'] = $id;
    }

    public function setName(string $name) {
      $_SESSION['name'] = $name;
    }

    public function setUserType(string $type) {
      $_SESSION['usertype'] = $type;
    }

    public function addMessage(string $type, string $text) {
      $_SESSION['messages'][] = array('type' => $type, 'text' => $text);
    }

    public function getMessages() {
      return $this->messages;
    }
  }
?>