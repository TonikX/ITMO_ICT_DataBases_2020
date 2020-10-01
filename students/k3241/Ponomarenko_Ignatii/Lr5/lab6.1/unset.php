<?php

function unset_session()
  {
    $_SESSION = array();
    session_destroy();
  }

  unset_session();
  var_dump($_SESSION);

?>