<?php
/*
 * Plugin Name: Cabinet Khaloui Auguste
 * Description: Cabinet Khaloui Auguste
 * Version: 1.0
 * Author: Ludwig SILVAIN
 * Author URI: https://silvain.eu
 * License: GPLv2 or later
 */


/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2015 Ludwig SILVAIN
*/

class Cabinet_Khaloui_Auguste
{

  function __construct()
  {
    /* Reset Password */
    add_filter('show_password_fields', [$this, 'disable_reset_password']);
    add_filter('allow_password_reset', [$this, 'disable_reset_password']);
    add_filter('gettext', [$this, 'remove_reset_password_text']);
    add_action("login_init", [$this, "redirect_from_reset_password"]);

    /* Login */
    add_filter('login_errors', [$this, "password_error"]);

     /* Version Wordpress */
    add_filter('the_generator', [$this, 'remove_wp_version_rss']);

    /* Masquer les pages des autheurs */
    add_action('template_redirect', [$this, 'hide_author_page']);
  }

  /* Reset Password */
  function disable_reset_password() : bool
  {
    return false;
  }

  function remove_reset_password_text($text) : string
  {
    return str_replace(array('Lost your password?', 'Lost your password'), '', trim($text, '?'));
  }

  function redirect_from_reset_password() : void
  {
    if (isset($_GET['action'])) {
      if (in_array($_GET['action'], array('lostpassword', 'retrievepassword'))) {
        wp_redirect(wp_login_url(), 301);
        exit;
      }
    }
  }

  /* Login */
  function password_error($a) : string
  {
    return 'The username or password is incorrect. Please consult your system administrator.';
  }

  /* Version Wordpress */
  function remove_wp_version_rss() : string
  {
    return '';
  }

  /* Masquer les pages des autheurs */
  function hide_author_page() : void
  {
    if (is_author()) {
      wp_redirect(get_option('home'), 301);
      exit;
    }
  }
}

$cabinet_khaloui_auguste = new Cabinet_Khaloui_Auguste();
