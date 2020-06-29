<?php 
  $select_name = $_GET['name'];
  
  switch ($select_name) {
      case 'ASC':
   $select_name_sort = "ASC";
   $name_sort = "name";
   break;
      case 'DESC':
   $select_name_sort =  "DESC";
   $name_sort = "name";
   break;
  }
  
  
  $select_email = $_GET['email'];
  
  switch ($select_email) {
      case 'ASC':
   $select_name_sort = "ASC";
   $name_sort = "email";
   break;
      case 'DESC':
   $select_name_sort =  "DESC";
   $name_sort = "email";
   break;
  }
  
  
  
  $select_check = $_GET['check'];
  
  switch ($select_check) {
      case 'ASC':
   $select_name_sort = "ASC";
   $name_sort = "checkbox";
   break;
      case 'DESC':
   $select_name_sort =  "DESC";
   $name_sort = "checkbox";
   break;
  }
  
  
  if(!empty($select_name) || !empty($select_email)  || !empty($select_check)) {
     $query_filter = "ORDER BY $name_sort $select_name_sort"; 
    
  } 
  
  else {
      $query_filter = '';
  }
  
 ?>