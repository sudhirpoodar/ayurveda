<?php

if ( ! class_exists( 'RS_Caching_PhpFastCache' ) ) {

  class RS_Caching_PhpFastCache {

    public $path = '';

    public function __construct() {

      $this->path = dirname( __FILE__ ) .'/cache/';
      $this->rs_connect();

    }

    public function rs_connect() {
      return is_writable( $this->path );
    }

    public function rs_set( $key, $value ) {
      return @file_put_contents( $this->path .'/'. $key, $value );
    }

    public function rs_get( $key ) {
      return @file_get_contents( $this->path .'/'. $key );
    }

    public function rs_del( $key ) {
      return @unlink( $this->path .'/'. $key );
    }

    public function rs_exists( $key ) {
      return @file_exists( $this->path .'/'. $key );
    }

    public function rs_flush() {

      foreach( glob( $this->path . '*' ) as $file ) {
        @unlink( $file );
      }

      return true;

    }

    public function rs_info( $key ) {

      $count = 0;
      $size  = 0;
      $disk  = disk_free_space( $this->path );

      foreach ( glob( $this->path .'*' ) as $file ) {
        $size += filesize( $file );
        $count++;
      }

      $info = array(
        'cached' => $count,
        'size'   => $this->rs_human_filesize( $size ),
        'disk'   => $this->rs_human_filesize( $disk ),
        'used'   => number_format( max( 0.1, ( $size * 100 ) / $disk ) , 1 )
      );

      return ( isset( $info[$key] ) ) ? $info[$key] : '';

    }

    public function rs_human_filesize( $bytes ) {

      if ( $bytes >= 1048576 ) {
        $bytes = number_format( $bytes / 1048576 ) . ' <small>MB</small>';
      } else {
        $bytes = number_format( $bytes / 1024 ) . ' <small>KB</small>';
      }

      return $bytes;

    }

  }
}
