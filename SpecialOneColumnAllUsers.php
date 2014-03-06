<?php
if ( !defined( 'MEDIAWIKI' ) ) {
   die( 'This file is a MediaWiki extension. It is not a valid entry point' );
}

class SpecialOneColumnAllUsers extends SpecialPage {
   function __construct( ) {
      parent::__construct( 'OneColumnAllUsers' );
   }

   function execute( $par ) {
      $this->setHeaders();
      $viewOutput = $this->getOutput();
      $dbr = wfGetDB( DB_SLAVE );
      global $wgSitename;
      $output = "<big>'''" . wfMessage( 'onecolumnallusers-intro', $wgSitename )->plain()
         . "'''</big><br>";
      $namespaces = MWNamespace::getCanonicalNamespaces();
      $res = $dbr->select( 'user', array ( 'user_name' ), '1=1',
         __METHOD__, array( 'ORDER BY' => 'user_id ASC' ) );
      foreach ( $res as $row ) {
         $output .= "[[User:" . $row->user_name . "|" . $row->user_name . "]]<br>";
      }
      $viewOutput->addWikiText( $output );
      return $output;
   }
}
