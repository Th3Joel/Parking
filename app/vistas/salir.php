<?php

session_destroy();
session_unset();
echo "<script type='text/javascript'>
  			window.location.reload();
		</script>";