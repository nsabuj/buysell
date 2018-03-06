<?php


if (! function_exists('ad_single_image')) {
    /**
     * Get the available auth instance.
     *
     * @param  string|null  $guard
     * @return \Illuminate\Contracts\Auth\Factory|\Illuminate\Contracts\Auth\Guard|\Illuminate\Contracts\Auth\StatefulGuard
     */
    function ad_single_image($array)
    {
          foreach ($array as $key=>$image){
              if($key==0){
                  break;
              }
          }
          if(!empty($image)) {
              return $image->filename;
          }else{
              return '';
          }
    }
}


if (! function_exists('get_user_template')) {
    /**
     * Get the available auth instance.
     *
     * @param  string|null  $guard
     * @return \Illuminate\Contracts\Auth\Factory|\Illuminate\Contracts\Auth\Guard|\Illuminate\Contracts\Auth\StatefulGuard
     */
    function get_user_template($role)
    {
        if($role=='seller') {
            $template='seller.sellerdashboard';
                }elseif ($role=='administrator') {

$template='backpack::layout';
                }else {
            $template='user.dashboardtemplate';

                }

                return $template;

    }
}

?>