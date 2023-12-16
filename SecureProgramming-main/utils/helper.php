<?php

  Class Helper {
    public static function stripTags($text) {
      return strip_tags($text);
    }

    public static function xFrameRemove() {
      header_remove('X-Powered-by');
    }
  }