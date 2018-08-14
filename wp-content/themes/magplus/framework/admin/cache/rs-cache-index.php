<?php

if ( ! class_exists( 'RS_Caching_Index' ) ) {
  class RS_Caching_Index {

    public static $url     = null;
    public static $key     = null;
    public static $caching = null;
    public static $config = array( 'engine' => 'none', 'exclude_query' => '', 'exclude_url' => '' );

    public static function rs_is_cache() {

      $start = microtime();

      if ( isset( $_GET['nocache'] ) ) {
        return false;
      }
      
      self::$url = self::rs_get_url();
      self::$key = md5( self::$url );

      $config_file = dirname( __FILE__ ) .'/config.json';

      if ( $config_content = file_get_contents( $config_file ) ) {
        self::$config = json_decode( $config_content, true );
      }

      //
      // check engine should be engaged
      if ( self::$config['engine'] === 'none' ) {
        return false;
      }

      //
      foreach( explode( "\r", self::$config['exclude_url'] ) as $exclude_url ) {
        if( ( substr( $exclude_url, -1 ) === '*' && preg_match( '#'. $exclude_url .'\/*#', self::$url ) ) || self::$url === $exclude_url ) {    
          return false;  
        }
      }

      //
      // Connect to Caching engine
      include_once dirname( __FILE__ ) .'/rs-phpfastcache.php';
      self::$caching = new RS_Caching_PhpFastCache();
      

      if( ! self::$caching->rs_connect() ) {
        return false;
      }

      if( isset( $_GET['flushcache'] ) ) {
        self::$caching->rs_del( self::$key );
      }

      if( isset( $_GET['flushall'] ) ) {
        self::$caching->rs_flush();
      }

      //
      // check engine should be engaged
      if ( self::$config['exclude_query'] === 'ON' && ! empty( $_GET ) ) {
        return false;
      }

      if ( ! empty( $_POST ) || preg_match( '/wordpress_logged_in/', var_export( $_COOKIE, true ) ) ) {
        return false;
      }


      if ( self::$caching->rs_exists( self::$key ) ) {

        echo self::$caching->rs_get( self::$key );

        echo "\n<!-- Page generated in " . self::rs_get_time_elapsed( $start, microtime() ) . " seconds. -->\n";
        echo "<!-- Cache key: " . self::$key . " -->\n";
        echo "<!-- Cached URL: " . self::$url . " -->\n";

        die();

      }

      // Cache the page!
      return true;

    }

    public static function rs_set_key_callback( $content ) {


      if ( trim( $content ) == '' || substr( trim( $content ), 0, 1 ) == '{' ) {
        return $content;
      }

      if( ! is_feed() && ! is_404() && ! is_search() ) {
        if( ! self::$caching->rs_set( self::$key, $content ) ) {
          self::$caching->rs_del( self::$key );
        }
      }

      return $content;

    }

    public static function rs_get_time_elapsed( $start, $end ) {
      return round( self::rs_get_micro_time( $end ) - self::rs_get_micro_time( $start ), 5 );
    }

    public static function rs_get_micro_time( $time ) {
      list( $usec, $sec ) = explode( " ", $time );
      return ( (float) $usec + (float) $sec );
    }

    public static function rs_get_url() {

      $proto = 'http';

      if ( isset( $_SERVER['HTTPS'] ) && ( 'on' === strtolower( $_SERVER['HTTPS'] ) || '1' === $_SERVER['HTTPS'] ) ) {
        $proto .= 's';
      } elseif ( isset( $_SERVER['SERVER_PORT'] ) && ( '443' == $_SERVER['SERVER_PORT'] ) ) {
        $proto .= 's';
      }

      $url = parse_url( $proto . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] );


      if ( ! empty( $url ) ) {
        $qs = '';
        if ( ! empty( $_GET ) ) {
          $ignore = array( 'flushcache', 'nocache', 'flushall' );
          $ignore = array_flip( $ignore );
          $_qs = array_diff_key( $_GET, $ignore );
          if ( ! empty( $_qs ) ) {
            $qs = '?';
            foreach ( $_qs as $key => $value ) {
              if ( strlen( $qs ) > 1 ) {
                $qs .= '&';
              }
              $qs .= "{$key}={$value}";
            }
            $qs = preg_replace( '#[^A-Z0-9=\-\?\&]#i', '', $qs );
          }
        }
        $url = $url['scheme'] . '://' . $url['host'] . $url['path'] . $qs;
      } else {
        $url = microtime();
      }

      return $url;

    }

  }

}

if( RS_Caching_Index::rs_is_cache() ) {

  ob_start( ['RS_Caching_Index', 'rs_set_key_callback'] );

  define( 'WP_USE_THEMES', true );

  require './wp-blog-header.php';

  ob_end_flush();

  die();

}
