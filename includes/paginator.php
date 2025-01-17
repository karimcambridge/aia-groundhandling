<?php

  class Paginator {
    private $_conn;
    private $_limit;
    private $_page;
    private $_query;
    private $_total;
    private $_results = array();
  
    public function __construct( $conn, $query ) {
       
      $this->_conn = $conn;
      $this->_query = $query;
   
      $rs = $this->_conn->query( $this->_query );
      $this->_total = $rs->num_rows;
    }

    public function getData( $limit = 10, $page = 1 ) {
       
      $this->_limit   = $limit;
      $this->_page    = $page;
   
      if ( $this->_limit == 'all' ) {
          $query      = $this->_query;
      } else {
          $query      = $this->_query . " LIMIT " . ( ( $this->_page - 1 ) * $this->_limit ) . ", $this->_limit";
      }
      $rs             = $this->_conn->query( $query );
   
      while ( $row = $rs->fetch_assoc() ) {
          $this->_results[]  = $row;
      }

      $result         = new stdClass();
      $result->page   = $this->_page;
      $result->limit  = $this->_limit;
      $result->total  = $this->_total;
      $result->data   = $this->_results;
   
      return $result;
    }

    public function createLinks( $links, $list_class, $count ) {
      if ( $this->_limit == 'all' ) {
          return '';
      }
      $previousLinks = keepLinks("airwaybill");
      $last       = ceil( $this->_total / $this->_limit );
   
      $start      = ( ( $this->_page - $links ) > 0 ) ? $this->_page - $links : 1;
      $end        = ( ( $this->_page + $links ) < $last ) ? $this->_page + $links : $last;

      $html       = '<ul class="' . $list_class . '">';
   
      if($this->_page >= 1 && $count >= 1) {
        $class      = ( $this->_page == 1 ) ? "page-item disabled" : "page-item";
        $html       .= '<li class="' . $class . '"><a class="page-link" href="?limit=' . $this->_limit . '&page=' . ( $this->_page - 1 ) . $previousLinks . '">&laquo; Previous</a></li>';
      }
      else if($count == 0) {
        $class      = ( $this->_page == 1 ) ? "page-item disabled" : "page-item";
        $html       .= '<li class="' . $class . '"><a class="page-link" href="?limit=' . $this->_limit . '&page=' . ( $this->_page - 1 ) . $previousLinks . '">None</a></li>';
      }
      if ( $start > 1 ) {
          $html   .= '<li><a href="?limit=' . $this->_limit . '&page=1">1</a></li>';
          $html   .= '<li class="disabled"><span>...</span></li>';
      }
   
      for ( $i = $start ; $i <= $end; $i++ ) {
          $class  = ( $this->_page == $i ) ? "page-item active" : "page-item";
          $html   .= '<li class="' . $class . '"><a class="page-link" href="?limit=' . $this->_limit . '&page=' . $i . $previousLinks . '">' . $i . '</a></li>';
      }
   
      if ( $end < $last ) {
          $html   .= '<li class="disabled"><span>...</span></li>';
          $html   .= '<li><a href="?limit=' . $this->_limit . '&page=' . $last . $previousLinks . '">' . $last . '</a></li>';
      }
   
      if($this->_page <= $last) {
        $class      = ( $this->_page == $last ) ? "page-item disabled" : "page-item";
        $html       .= '<li class="' . $class . '"><a class="page-link" href="?limit=' . $this->_limit . '&page=' . ( $this->_page + 1 ) . $previousLinks . '">Next &raquo;</a></li>';
      }
      $html       .= '</ul>';
   
      return $html;
    }
  }
?>